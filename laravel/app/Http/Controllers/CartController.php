<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Muestra el carrito del usuario autenticado
    public function index()
    {
        // Obtener todos los productos del carrito para el usuario autenticado
        $cartItems = Cart::with('product')
                         ->where('user_id', Auth::id())
                         ->get();

        // Pasar los cartItems a la vista
        return view('cart.index', compact('cartItems'));
    }

    // Agregar un producto al carrito
    public function addToCart(Request $request, $productId)
    {
        // Asegurarse de que la cantidad es válida
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el producto desde la base de datos
        $product = Product::findOrFail($productId);

        // Verificar si el producto ya está en el carrito del usuario autenticado
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Si ya existe, solo actualiza la cantidad
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Si no existe, crea un nuevo item en el carrito
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        // Redirige al carrito con un mensaje de éxito
        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito');
    }

    // Eliminar un producto del carrito
    public function removeFromCart($productId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->route('cart.index')->with('error', 'Producto no encontrado en el carrito');
    }
}
