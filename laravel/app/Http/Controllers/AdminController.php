<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return view('admin.dashboard');
    }
}