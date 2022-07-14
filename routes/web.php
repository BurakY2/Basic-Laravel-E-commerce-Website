<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SmartWatchController;
use App\Http\Controllers\EdebiyatController;
use App\Http\Controllers\TabletController;
use App\Http\Controllers\RomanController;
use App\Http\Controllers\BilimController;
use Gloudemans\Shoppingcart\Facades\Cart;

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


Route::get('/', [ProductsController::class,'index']);
//Route::get('/product/{product}', 'ProductsController@show')
Route::get('/product/{product}', [ProductsController::class,'show'])->name('product.show');



/*
Route::get('/', function () {
    return view('product');
});*/

Route::get('/phone', [PhoneController::class,'index'])->name('phone.index');
Route::get('/smartwatch', [SmartWatchController::class,'index'])->name('smartwatch.index');
Route::get('/edebiyat', [EdebiyatController::class,'index'])->name('edebiyat.index');
Route::get('/tablet', [TabletController::class,'index'])->name('tablet.index');
Route::get('/roman', [RomanController::class,'index'])->name('roman.index');
Route::get('/bilim', [BilimController::class,'index'])->name('bilim.index');


Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart', [CartController::class,'store'])->name('cart.store');
Route::delete('/cart/{product}', [CartController::class,'destroy'])->name('cart.destroy');
Route::patch('/cart/{id}', [CartController::class,'update'])->name('cart.update');
Route::patch('/cart/{id}/edit', [CartController::class,'edit'])->name('cart.edit');

Route::get('/empty', function(){
    Cart::destroy();
});


//Route::get('/phone', 'PhoneController@index')->name('phone');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


