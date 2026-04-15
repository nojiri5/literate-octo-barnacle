<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
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

Auth::routes();

    Route::get('/register/confirm',function(){return view('auth.confirm');})->name('register.confirm');
    
//商品一覧
Route::get('/main',[ProductController::class,'index'])->name('products.index'); 
Route::get('/search',[ProductController::class,'search'])->name('products.search');
Route::get('/products/{id}',[ProductController::class,'show'])->name('prodcuts.show'); 

//カート
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{id}',[CartController::class,'add'])->name('cart.add');
Route::post('/cart/update/{id}',[CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');

//購入確認
Route::get('/checkout',[CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/complete',[CheckoutController::class, 'complete'])->name('checkout.complete');

//購入履歴
Route::get('/orders/history',[OrderController::class,'history'])->name('orders.history');


//事業者専用
Route::middleware('auth')->prefix('admin')->group(function(){
Route::get('/products',[AdminProductController::class,'index'])->name('admin.products.index');
Route::get('/products/create',[AdminProductController::class,'create'])->name('admin.products.create');
Route::post('/products',[AdminProductController::class,'store'])->name('admin.products.store');
Route::get('/products/{id}/edit',[AdminProductController::class,'edit'])->name('admin.products.edit');
Route::post('/products/{id}/update',[AdminProductController::class,'update'])->name('admin.products.update');
Route::post('/products/{id}/delete',[AdminProductController::class,'destroy'])->name('admin.products.destroy');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products','ProductController');

