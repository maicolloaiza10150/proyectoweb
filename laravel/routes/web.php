<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});



// Ruta para ver el carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Ruta para agregar un producto al carrito
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

// Ruta para el checkout (pago)
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
