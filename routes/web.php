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
Route::get('/panier', 'App\Http\Controllers\ClientController@cart');
Route::get('/client_login', 'App\Http\Controllers\ClientController@client_login');
Route::get('/signup', 'App\Http\Controllers\ClientController@signup');
Route::get('/paiement', 'App\Http\Controllers\ClientController@checkout');

Route::get('/admin', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/order', 'App\Http\Controllers\AdminController@order');


Route::get('/ajoutercategorie', 'App\Http\Controllers\CategoryController@addcategory');
Route::post('/savecategory', 'App\Http\Controllers\CategoryController@savecategory');
Route::get('/categories', 'App\Http\Controllers\CategoryController@categories');

Route::get('/ajouterproduit', 'App\Http\Controllers\ProductController@addproduct');
Route::post('/saveproduct', 'App\Http\Controllers\ProductController@saveproduct');
Route::get('/products', 'App\Http\Controllers\ProductController@products');

Route::get('/ajouterslider', 'App\Http\Controllers\SliderController@addslider');
Route::post('/saveslider', 'App\Http\Controllers\SliderController@saveslider');
Route::get('/sliders', 'App\Http\Controllers\SliderController@sliders');





