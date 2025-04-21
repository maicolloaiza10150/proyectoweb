@extends('layouts.app')

@section('title', 'Dashboard de Admin')

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Productos -->
                <a href="{{ route('admin.products.index') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gestionar Productos</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Ver, editar y eliminar productos de la tienda.</p>
                </a>

                <!-- Crear Producto -->
                <a href="{{ route('admin.products.create') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Nuevo Producto</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Agregar un nuevo producto a la tienda.</p>
                </a>

                <!-- Usuarios -->
                <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gestionar Usuarios</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Ver, editar y eliminar usuarios registrados.</p>
                </a>

            </div>
        </div>
    </div>
@endsection
