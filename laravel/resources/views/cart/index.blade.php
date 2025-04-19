@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Carrito de Compras</h1>

    <div class="space-y-4">
        @foreach ($cartItems as $item)
            <div class="border-b py-4">
                <h2 class="text-lg font-semibold">{{ $item->product->name }}</h2>
                <p>Cantidad: {{ $item->quantity }}</p>
                <p>Precio: ${{ number_format($item->product->precio * $item->quantity, 2) }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('cart.checkout') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Proceder al Pago</a>
@endsection
