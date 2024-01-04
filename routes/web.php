<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/slideredit', [App\Http\Controllers\SliderEditController::class, 'index'])->name('slideredit');
Route::post('/slideredit', [App\Http\Controllers\SliderEditController::class, 'store'])->name('slideredit.store');
Route::get('/slideredit/edit/{id}', [App\Http\Controllers\SliderEditController::class, 'show'])->name('slideredit.show');
Route::delete('/slideredit/{id}', [App\Http\Controllers\SliderEditController::class, 'destroy'])->name('slideredit.destroy');
Route::put('/slideredit/{id}', [App\Http\Controllers\SliderEditController::class, 'update'])->name('slideredit.update');

Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::put('/order/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('order.update');


Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::post('/shop', [App\Http\Controllers\ShopController::class, 'show'])->name('shopByCategory');

Route::get('/shop/categoryedit', [App\Http\Controllers\CategoriesEditController::class, 'index'])->name('CategoryEdit');
Route::post('/shop/categoryedit', [App\Http\Controllers\CategoriesEditController::class, 'store'])->name('CategoryEdit.store');
Route::delete('/shop/categoryedit/{id}', [App\Http\Controllers\CategoriesEditController::class, 'destroy'])->name('CategoryEdit.destroy');

Route::get('/shop/product', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::get('/shop/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::post('/shop/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::delete('/shop/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/shop/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::put('/shop/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');

Route::delete('/shop/product/edit/{id}', [App\Http\Controllers\ProductPhotoController::class, 'destroy'])->name('productPhoto.destroy');


Route::post('/shop/product/comment', [App\Http\Controllers\CommentsController::class, 'store'])->name('comments.store');
Route::put('/shop/product/comment/{id}', [App\Http\Controllers\CommentsController::class, 'update'])->name('comments.update');
Route::delete('/shop/product/comment/{id}', [App\Http\Controllers\CommentsController::class, 'destroy'])->name('comments.destroy');

Route::get('/admin/comments', [App\Http\Controllers\CommentAcceptingController::class, 'index'])->name('commentsAccept.index');
Route::put('/admin/comments/{id}', [App\Http\Controllers\CommentAcceptingController::class, 'update'])->name('commentsAccept.update');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::put('/cart/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
