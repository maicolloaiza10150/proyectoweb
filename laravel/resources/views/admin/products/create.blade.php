@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center mt-4">
    <div class="card p-4 shadow-lg rounded-lg bg-white max-w-md w-full">
        <h2 class="text-xl font-semibold text-center mb-4 text-gray-800">Crear Producto</h2>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">

                <!-- Nombre del Producto -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                    <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" required placeholder="Ingresa el nombre del producto">
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Ingresa una descripción del producto"></textarea>
                </div>

                <!-- Stock y Precio -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stock" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" required placeholder="Cantidad disponible">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="number" name="price" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" required placeholder="Ingresa el precio del producto">
                    </div>
                </div>

                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select name="category_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div>
                    <label for="status_id" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecciona un estado</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->descripcion }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Imagen -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
                    <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                </div>
            </div>

            <!-- Botón de Guardar -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
