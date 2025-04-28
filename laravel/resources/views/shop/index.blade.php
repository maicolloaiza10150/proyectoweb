@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold mb-4">Productos Disponibles</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-gray-100 rounded-lg p-4 shadow hover:shadow-md transition">
                
               
                <div class="mb-3">
                    @if ($product->image)
                        <img src="data:image/jpeg;base64,{{ $product->image }}" alt="Current Image" class="mb-2 max-w-[300px] h-auto mx-auto">
                    @else
                        <p>No image available.</p>
                    @endif
                </div>
                
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-600 text-sm mb-2">{{ $product->descripcion }}</p>
                <p class="text-green-600 font-bold mb-2">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500 mb-3">Stock: {{ $product->stock }}</p>

                @if ($product->stock > 0)
<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1"> 
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-3 w-full">
        Agregar al carrito
    </button>
</form>
                @else
                    <span class="text-sm text-red-500 font-semibold">Sin stock</span>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
