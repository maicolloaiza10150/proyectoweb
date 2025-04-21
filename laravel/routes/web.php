<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Rutas de productos
    Route::resource('/products', ProductAdminController::class);

    // Rutas de usuarios
    Route::resource('/users', UserController::class);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('/home', function () {
    return redirect()->route('dashboard'); // o puedes retornar una vista personalizada
})->name('home');


require __DIR__.'/auth.php';
