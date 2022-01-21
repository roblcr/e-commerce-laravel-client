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





