<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;


/*
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
Route::resource('products','ProductController');
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

//レビュー
Route::get('/reviews/{productId}',[ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews/{productId}',[ReviewController::class, 'store'])->name('reviews.store');

//マイページ
Route::get('/mypage', [UserController::class, 'show'])->name('mypage');
Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
Route::post('/mypage/update', [UserController::class, 'update'])->name('mypage.update');

Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{productId}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::post('/favorites/{productId}/delete', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});


//事業者専用
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', function () {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        return view('admin.dashboard');
    })->name('dashboard');

Route::resource('products', 'Admin\ProductController');
Route::get('/users',[AdminUserController::class,'index'])->name('users.index');
Route::get('/products',[AdminProductController::class,'index'])->name('products.index');
Route::get('/products/create',[AdminProductController::class,'create'])->name('products.create');
Route::post('/products',[AdminProductController::class,'store'])->name('products.store');
Route::get('/products/{id}/edit',[AdminProductController::class,'edit'])->name('products.edit');
Route::post('/products/{id}/update',[AdminProductController::class,'update'])->name('products.update');
Route::post('/products/{id}/delete',[AdminProductController::class,'destroy'])->name('products.destroy');
});



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');


