<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController as ProductsHomeController;




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

Route::get('/products', [CartController::class,'index']);
Route::get('/products/cart', [CartController::class,'cart']);
Route::get('/products/{slug}', [ProductsHomeController::class,'details']);
Route::get('/products', [ProductsHomeController::class,'index']);
Route::get('/products/cart', [CartController::class,'cart']);
Route::get('/products/add-to-cart/{id}', [CartController::class,'addToCart'])->name('add-to-cart');
Route::get('/products/remove-from-cart/{id}', [CartController::class,'removeFromCart'])->name('remove-from-cart');
Route::get('/products/{slug}', [ProductsHomeController::class,'details'])->name("product.details");

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix("admin")->middleware(['auth'])->group(function(){    
    Route::get("/",[HomeController::class,'index']);
    
    Route::resource("category",CategoryController::class);
    Route::get("category/{id}/delete",[CategoryController::class,'destroy'])->name("category.delete");

    Route::resource("products",ProductController::class);
    Route::get("products/{id}/delete",[ProductController::class,'destroy'])->name("products.delete");

});