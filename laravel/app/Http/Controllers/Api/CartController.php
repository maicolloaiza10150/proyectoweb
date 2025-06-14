<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
                         ->where('user_id', Auth::id())
                         ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        $this->exportToJson();

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito');
    }

    public function removeFromCart($productId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->exportToJson();
            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->route('cart.index')->with('error', 'Producto no encontrado en el carrito');
    }

    private function exportToJson()
    {
        $cartItems = Cart::all()->map(function ($item) {
            return [
                'user_id' => $item->user_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ];
        });

        $jsonPath = database_path('data/carts.json');
        File::ensureDirectoryExists(dirname($jsonPath));
        File::put($jsonPath, json_encode($cartItems, JSON_PRETTY_PRINT));
    }
}
