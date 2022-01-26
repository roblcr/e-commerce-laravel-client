<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function addproduct() {

        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.addproduct')->with('categories', $categories);
    }

    public function saveproduct(Request $request) {
        $this->validate($request, [
            'product_price' => 'required|unique:products',
            'product_name' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999']);

            if($request->hasFile('product_image')){
                $fileNameWithExtension = $request->file('product_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'. time() .'.'. $extension;

                // upload de l'image

                $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

            }
            else {
                $fileNameToStore = 'noimage.jpg';
            }

            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_category = $request->input('product_category');
            $product->product_image = $fileNameToStore;
            $product->status = 1;

            $product->save();

            return redirect('/ajouterproduit')->with('status', 'le produit ' . $product->product_name . ' a été inséré avec succés');

    }

    public function products() {

        $produits = Product::get();

        return view('admin.products')->with('produits', $produits);
    }

    public function edit($id){
        $product = Product::find($id);
        $category = Category::all()->pluck('category_name', 'category_name');
        return view('admin.editproduct')->with('product', $product)->with('category', $category);
    }

    public function editproduct(Request $request){
        $this->validate($request, [
            'product_price' => 'required',
            'product_name' => 'required',
            'product_category' => 'required',
            'product_image' => 'image|nullable|max:1999']);


            $product = Product::find($request->input('id'));
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_category = $request->input('product_category');

            if($request->hasFile('product_image')){
                $fileNameWithExtension = $request->file('product_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'. time() .'.'. $extension;

                // upload de l'image

                $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);

                if($product->product_image != 'noimage.jpg'){
                    Storage::delete('public/product_images/' .$product->product_image);
                }

                $product->product_image = $fileNameToStore;
            }

            $product->update();

            return redirect('/products')->with('status', 'le produit ' . $product->product_name . ' a été modifié avec succés');
    }

    public function delete($id) {
        $product = Product::find($id);

        if($product->product_image != 'noimage.jpg'){
            Storage::delete('public/product_images/' .$product->product_image);
        }

        $product->delete();

        return redirect('/products')->with('status', 'Le produit '.$product->product_name.' a bien été suprimée');
    }
}
