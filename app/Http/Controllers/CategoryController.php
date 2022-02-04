<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addcategory() {
        return view('admin.addcategory');
    }

    public function savecategory(Request $request) {
        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $category = new Category();

        $category->category_name = $request->input('category_name');

        $category->save();

        return redirect('/ajoutercategorie')->with('status', 'La catégorie '.$category->category_name.' a bien été créée');
    }

    public function categories() {

        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }

    public function edit($id) {
        $category = Category::find($id);

        return view('admin.editcategory')->with('category', $category);
    }

    public function editcategory(Request $request) {

        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $category = Category::find($request->input('id'));

        $category->category_name = $request->input('category_name');

        $category->update();

        return redirect('/categories')->with('status', 'La catégorie '.$category->category_name.' a bien été modifiée');
    }

    public function delete($id) {

        $category = Category::find($id);

        $category->delete();

        return redirect('/categories')->with('status', 'La catégorie '.$category->category_name.' a bien été suprimée');
    }
}
