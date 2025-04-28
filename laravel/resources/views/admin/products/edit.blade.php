@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-6">
    <div class="bg-white shadow rounded-xl p-8">
        <br>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Editar Producto</h2>

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" rows="4" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $product->descripcion }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select name="category_id" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status_id" class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ $product->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                @if ($product->image)
                    <img src="data:image/jpeg;base64,{{ $product->image }}" alt="Imagen actual" class="w-64 h-auto rounded shadow mx-auto mb-2">
                @else
                    <p class="text-gray-500 italic">No hay imagen disponible.</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Subir nueva imagen</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>


<div class="h-12"></div>
@endsection
