<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // Mostrar los productos en el carrito
    public function index()
    {
        $cartItems = Cart::with('product')->get(); // Obtener todos los artículos del carrito
        return view('cart.index', compact('cartItems')); // Pasar los artículos al view
    }

    // Agregar un producto al carrito
    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->cantidad;
        $cart->save();

        return redirect()->route('cart.index');
    }

    // Procesar el checkout (simulación de pago)
    public function checkout()
    {
        return view('cart.checkout'); // Mostrar vista de checkout
    }
}
