@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Tu Carrito de Compras</h1>

    @if($cartItems->isEmpty())
        <p class="text-center text-gray-500">Tu carrito está vacío.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cartItems as $cartItem)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
                    <!-- Imagen del producto -->
                    <div class="bg-gray-200 rounded-t-lg p-4">
                        @if ($cartItem->product->image)
                            <img src="data:image/jpeg;base64,{{ $cartItem->product->image }}" alt="Product Image" class="mx-auto mb-4 max-w-[250px] h-auto object-cover rounded-md">
                        @else
                            <p class="text-center text-gray-400">No image available.</p>
                        @endif
                    </div>

                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $cartItem->product->name }}</h2>
                        <p class="text-sm text-gray-500 mb-4">{{ $cartItem->product->descripcion }}</p>
                        <p class="text-lg font-bold text-green-600 mb-3">${{ number_format($cartItem->product->price, 2) }}</p>
                        <p class="text-sm text-gray-500 mb-4">Cantidad: {{ $cartItem->quantity }}</p>

                        <!-- Formulario para eliminar producto del carrito -->
                        <form action="{{ route('cart.remove', $cartItem->product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white w-full py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 ease-in-out">
                                Eliminar del carrito
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('checkout.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-300 ease-in-out shadow-md">
            Proceder al Pago
        </a>
    </div>
</div>
@endsection
