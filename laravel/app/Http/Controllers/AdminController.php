<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');  
        }
    
        
        if (auth()->user()->role !== 'admin') {
            return redirect('/shop');  
        }
    
        
        return view('admin.dashboard');
    }

    
}
