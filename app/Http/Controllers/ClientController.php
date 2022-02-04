<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class ClientController extends Controller
{
    public function home() {
        $sliders = Slider::where('status', 1)->get();
        $products = Product::where('status', 1)->get();

        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }


    public function shop() {

        $categories = Category::get();
        $products = Product::where('status', 1)->get();
        return view('client.shop')->with('categories', $categories)->with('products',$products);
    }

    public function select_category($name)
    {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->where('status', 1)->get();

        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function add_cart($id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return Redirect::to('/shop');
    }

    public function cart() {

        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);

    }

    public function edit_cart($id, Request $request)
    {
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/cart');
    }

    public function remove_product($id)
    {
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect::to('/cart');
    }

    public function checkout() {

        if(!Session::has('cart')){
            return view('client.cart');
        }

        return view('client.checkout');
    }

    public function pay(Request $request)
    {

        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51KP4qMJtuOmbTkqnGzn7E4ZhEHcxOIQKV4xXTYfVEVtGvLMXrYlNkCvLoxzg610jtiuLr8ue0AfjVmFAQYvyT5hb00Riw31OkO');

        try{

            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "eur",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

            $orders = new Order();

            $orders->name = $request->input('name');
            $orders->address = $request->input('address');
            $orders->cart = serialize($cart);
            $orders->payment_id = $charge->id;

            $orders->save();



        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect::to('/checkout');
        }

        Session::forget('cart');
        // Session::put('success', 'Purchase accomplished successfully !');
        return redirect::to('/cart')->with('status', 'Achat accompli avec succès');
    }

    public function account_creation(Request $request)
    {
        $this->validate($request, ['email' => 'email|required|unique:clients',
                                    'password' => 'required|min:4']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Votre compte a été créée avec succès');
    }

    public function account_access(Request $request)
    {
        $this->validate($request, ['email' => 'email|required',
        'password' => 'required']);

        $client = Client::where('email', $request->input('email'))->first();

        if ($client) {
            # code...
            if (Hash::check($request->input('password'), $client->password)) {
                # code...
                Session::put('client', $client);
                return redirect('/shop');
            } else {
                # code...
                return back()->with('status', 'Mauvais mot de passe ou mauvaise adresse mail');
            }

        } else {
            # code...
            return back()->with('status', 'Vous n\'avez pas de compte');
        }


    }

    public function client_logout()
    {
        Session::forget('client');
        return back();
    }

    public function client_login() {
        return view('client.login');
    }

    public function signup() {
        return view('client.signup');
    }


}
