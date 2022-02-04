<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\ClientController@home');
Route::get('/shop', 'App\Http\Controllers\ClientController@shop');
Route::get('/cart', 'App\Http\Controllers\ClientController@cart');
Route::get('/client_login', 'App\Http\Controllers\ClientController@client_login');
Route::get('/signup', 'App\Http\Controllers\ClientController@signup');
Route::get('/checkout', 'App\Http\Controllers\ClientController@checkout');
Route::get('/select_categories/{name}', 'App\Http\Controllers\ClientController@select_category');
Route::get('/add_cart/{id}', 'App\Http\Controllers\ClientController@add_cart');
Route::post('/edit_qty/{id}', 'App\Http\Controllers\ClientController@edit_cart');
Route::get('/remove_product/{id}', 'App\Http\Controllers\ClientController@remove_product');
Route::post('/pay', 'App\Http\Controllers\ClientController@pay');
Route::post('/account_creation', 'App\Http\Controllers\ClientController@account_creation');
Route::post('/account_access', 'App\Http\Controllers\ClientController@account_access');
Route::get('/client_logout', 'App\Http\Controllers\ClientController@client_logout');


Route::get('/view_pdf/{id}', 'App\Http\Controllers\PdfController@view_pdf');


Route::get('/admin', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/order', 'App\Http\Controllers\AdminController@orders');


Route::get('/ajoutercategorie', 'App\Http\Controllers\CategoryController@addcategory');
Route::post('/savecategory', 'App\Http\Controllers\CategoryController@savecategory');
Route::get('/categories', 'App\Http\Controllers\CategoryController@categories');
Route::get('/edit_category/{id}', 'App\Http\Controllers\CategoryController@edit');
Route::post('/editcategory', 'App\Http\Controllers\CategoryController@editcategory');
Route::get('/delete_category/{id}', 'App\Http\Controllers\CategoryController@delete');

Route::get('/ajouterproduit', 'App\Http\Controllers\ProductController@addproduct');
Route::post('/saveproduct', 'App\Http\Controllers\ProductController@saveproduct');
Route::get('/products', 'App\Http\Controllers\ProductController@products');
Route::get('/edit_product/{id}', 'App\Http\Controllers\ProductController@edit');
Route::post('/editproduct', 'App\Http\Controllers\ProductController@editproduct');
Route::get('/delete_product/{id}', 'App\Http\Controllers\ProductController@delete');
Route::get('/activate_product/{id}', 'App\Http\Controllers\ProductController@activate');
Route::get('/deactivate_product/{id}', 'App\Http\Controllers\ProductController@deactivate');

Route::get('/ajouterslider', 'App\Http\Controllers\SliderController@addslider');
Route::post('/saveslider', 'App\Http\Controllers\SliderController@saveslider');
Route::get('/sliders', 'App\Http\Controllers\SliderController@sliders');
Route::get('/edit_slider/{id}', 'App\Http\Controllers\SliderController@edit');
Route::post('/editslider', 'App\Http\Controllers\SliderController@editslider');
Route::get('/delete_slider/{id}', 'App\Http\Controllers\SliderController@delete');
Route::get('/activate_slider/{id}', 'App\Http\Controllers\SliderController@activate');
Route::get('/deactivate_slider/{id}', 'App\Http\Controllers\SliderController@deactivate');






