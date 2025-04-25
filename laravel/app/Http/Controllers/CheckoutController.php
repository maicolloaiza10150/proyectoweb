<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Cart;  // Asegúrate de importar el modelo Cart
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Mostrar la vista de checkout con las tarjetas y métodos de pago disponibles
    public function index()
    {
        // Obtener todos los productos del carrito para el usuario autenticado
        $cartItems = Cart::with('product')
                         ->where('user_id', Auth::id())
                         ->get();

        // Pasar los cartItems a la vista
        return view('checkout.index', compact('cartItems'));
    }
    public function create()
    {
        $cards = Card::where('user_id', auth()->id())->get(); 
        $paymentMethods = PaymentMethod::all();
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        // Calcular el total
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->product->price * $cartItem->quantity;
        }
    
        return view('checkout.create', compact('cards', 'paymentMethods', 'totalAmount'));
    }
    // Procesar el pago
    public function store(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'card_id' => 'required|exists:cards,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'amount' => 'required|numeric|min:1',
    ]);

    // Obtener la tarjeta seleccionada
    $card = Card::find($request->card_id);

    // Obtener los productos del carrito con la relación cargada
    $cartItems = Cart::with('product')
                     ->where('user_id', Auth::id())
                     ->get();

    // Calcular el total de la compra
    $totalAmount = 0;
    foreach ($cartItems as $cartItem) {
        if ($cartItem->product) {
            $totalAmount += $cartItem->product->price * $cartItem->quantity;
        }
    }

    // Verificar si el saldo de la tarjeta es suficiente
    if ($card->saldo >= $totalAmount) {
        // Descontar el saldo de la tarjeta
        $card->saldo -= $totalAmount;
        $card->save();

        // Procesar cada producto en el carrito
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product) {
                // Reducir el stock
                $product = $cartItem->product;
                $product->stock -= $cartItem->quantity;
                $product->save();
            }

            // Eliminar del carrito
            $cartItem->delete();
        }

        return redirect()->route('checkout.index')->with('success', 'Pago realizado correctamente');
    } else {
        return redirect()->route('checkout.index')->with('error', 'Saldo insuficiente en la tarjeta');
    }
}
}
