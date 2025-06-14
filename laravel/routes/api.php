<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; // << Nuevo controlador para autenticación API
use App\Http\Controllers\Api\ProductController; // << O ProductAdminController si es solo para admin
use App\Http\Controllers\Api\AdminController; // << Nuevo o modificado para API
use App\Http\Controllers\Api\CheckoutController; // << Nuevo o modificado para API
use App\Http\Controllers\Api\UserController; // << Nuevo o modificado para API
use App\Http\Controllers\Api\ProfileController; // << Nuevo o modificado para API
use App\Http\Controllers\Api\CartController; // << Nuevo o modificado para API

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- Rutas de Autenticación (Públicas) ---
// Usan un AuthController específico para API que genera/maneja tokens Sanctum.
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- Rutas Públicas de API (No requieren autenticación) ---
// Por ejemplo, para mostrar productos a un visitante no logueado
Route::get('/shop', [ProductController::class, 'shop']); // Si shop es un endpoint API público

// --- Rutas Protegidas (requieren autenticación con Sanctum) ---
Route::middleware('auth:sanctum')->group(function () {

    // Ruta para obtener el usuario autenticado y para cerrar sesión
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas para el Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'show']); // Usar 'show' para GET, no 'edit'
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Rutas para el Carrito de Compras
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart']);
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart']);
    Route::patch('/cart/update/{productId}', [CartController::class, 'updateCartItem']); // Posible ruta para actualizar cantidad

    // Rutas para el Proceso de Checkout
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    // 'create' y otras rutas que devuelven formularios no tienen sentido en una API pura.
    // Una API típicamente recibe datos, no "crea" la vista de un formulario.
    // Route::get('/checkout/create', [CheckoutController::class, 'create']); // << Probablemente remover

    // --- Rutas de Administración (también protegidas por Sanctum) ---
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);

        // Uso de apiResource para CRUD completo
        Route::apiResource('/products', ProductController::class); // O ProductAdminController
        Route::apiResource('/users', UserController::class);
    });
});