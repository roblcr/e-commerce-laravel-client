<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

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

    public function cart() {
        return view('client.cart');
    }

    public function client_login() {
        return view('client.login');
    }

    public function signup() {
        return view('client.signup');
    }

    public function checkout() {
        return view('client.checkout');
    }
}
