@extends('layouts.app')

@section('title', 'Dashboard de Admin')

@section('content')
<div class="min-h-screen bg-white py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Título centrado -->
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">
            Panel de Administración
        </h1>

        <!-- Tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Productos -->
            <a href="{{ route('admin.products.index') }}" class="group block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"></path>
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold text-gray-900">Gestionar Productos</h5>
                </div>
                <p class="text-gray-600">Ver, editar y eliminar productos de la tienda.</p>
            </a>

            <!-- Crear Producto -->
            <a href="{{ route('admin.products.create') }}" class="group block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold text-gray-900">Nuevo Producto</h5>
                </div>
                <p class="text-gray-600">Agregar un nuevo producto a la tienda.</p>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('admin.users.index') }}" class="group block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1117.803 5.121M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h5 class="text-2xl font-bold text-gray-900">Gestionar Usuarios</h5>
                </div>
                <p class="text-gray-600">Ver, editar y eliminar usuarios registrados.</p>
            </a>

        </div>
    </div>
</div>
@endsection
