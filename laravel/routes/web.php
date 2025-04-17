<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::resource('productos', ProductoController::class);

Route::get('/', function () {
    return view('welcome');
});
