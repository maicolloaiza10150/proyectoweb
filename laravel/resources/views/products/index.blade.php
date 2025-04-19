@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Productos Disponibles</h1>

    <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        Agregar Producto
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-gray-100 rounded-lg p-4 shadow hover:shadow-md transition">
                
                <!-- Mostrar la imagen del producto -->
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
                
                <!-- Formulario para agregar al carrito -->
                <form action="{{ route('cart.store') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="payment_method_id" value="1"> <!-- temporal -->
                    <input type="hidden" name="status_id" value="1"> <!-- temporal -->
                    <input type="hidden" name="user_id" value="1"> <!-- temporal si no hay login -->

                    <div class="flex items-center space-x-2 mb-3">
                        <label for="cantidad_{{ $product->id }}" class="text-sm text-gray-600">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad_{{ $product->id }}" value="0" min="0" max="{{ $product->stock }}"
                               class="w-16 text-center border rounded px-2 py-1 text-sm">
                    </div>

                    @if ($product->stock > 0)
    <button type="submit" class="text-2xl text-white bg-blue-600 hover:bg-blue-700 rounded-full p-3">
        🛒
    </button>
@else
    <span class="text-sm text-red-500 font-semibold">Sin stock</span>
@endif

                </form>

                <!-- Botones de editar/eliminar -->
                <div class="space-x-2 mt-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-sm bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Editar</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
