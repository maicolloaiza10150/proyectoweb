<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
