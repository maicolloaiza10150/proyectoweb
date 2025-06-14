@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container mt-5 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Editar Usuario</h1>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-4 py-2 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-4 py-2 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Contraseña</label>
                <input type="password" name="password" class="w-full p-2 border rounded-md" placeholder="Deja en blanco si no deseas cambiarla">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded-md">
            </div>

            <div class="flex justify-center gap-4 mt-6">
                <button type="submit" class="btn btn-primary px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Actualizar Usuario</button>
                <a href="/admin/users" class="btn btn-secondary px-6 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
