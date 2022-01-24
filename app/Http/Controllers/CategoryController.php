<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addcategory() {
        return view('admin.addcategory');
    }

    public function savecategory(Request $request) {
        $this->validate($request, ['category_name' => 'required']);

        $category = new Category();

        $category->category_name = $request->input('category_name');

        $category->save();

        return redirect('/ajoutercategorie')->with('status', 'La catégorie '.$category->category_name.' a bien été créée');
    }

    public function categories() {

        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }
}
