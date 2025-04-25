<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');  // Redirige si no está autenticado
        }
    
        // Verificar si el usuario es un administrador
        if (auth()->user()->role !== 'admin') {
            return redirect('/shop');  // Redirige si no es admin
        }
    
        // Si pasa las verificaciones, se muestra el dashboard
        return view('admin.dashboard');
    }

    
}
