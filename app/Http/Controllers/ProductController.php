<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct() {

        $categories = Category::all()->pluck('category_name', 'category_name');

        return view('admin.addproduct')->with('categories', $categories);
    }

    public function saveproduct(Request $request) {
        $this->validate($request, [
            'product_price' => 'required',
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



    }

    public function products() {
        return view('admin.products');
    }
}
