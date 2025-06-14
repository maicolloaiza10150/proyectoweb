<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

use App\Models\Card;
use App\Models\PaymentMethod;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
                         ->where('user_id', Auth::id())
                         ->get();

        return view('checkout.index', compact('cartItems'));
    }

    public function create()
    {
        $cards = Card::where('user_id', auth()->id())->get(); 
        $paymentMethods = PaymentMethod::all();
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->product->price * $cartItem->quantity;
        }
    
        return view('checkout.create', compact('cards', 'paymentMethods', 'totalAmount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $card = Card::find($request->card_id);

        $cartItems = Cart::with('product')
                         ->where('user_id', Auth::id())
                         ->get();

        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product) {
                $totalAmount += $cartItem->product->price * $cartItem->quantity;
            }
        }

        if ($card->saldo >= $totalAmount) {
            $card->saldo -= $totalAmount;
            $card->save();

            foreach ($cartItems as $cartItem) {
                if ($cartItem->product) {
                    $product = $cartItem->product;
                    $product->stock -= $cartItem->quantity;
                    $product->save();
                }

                $cartItem->delete();
            }

            $jsonPath = database_path('data/carts.json');
            if (File::exists($jsonPath)) {
                $cartData = json_decode(File::get($jsonPath), true);

                $cartData = array_filter($cartData, function ($item) {
                    return $item['user_id'] != Auth::id();
                });

                $cartData = array_values($cartData); 
                File::put($jsonPath, json_encode($cartData, JSON_PRETTY_PRINT));
            }

            return redirect()->route('checkout.index')->with('success', 'Pago realizado correctamente');
        } else {
            return redirect()->route('checkout.index')->with('error', 'Saldo insuficiente en la tarjeta');
        }
    }
}
