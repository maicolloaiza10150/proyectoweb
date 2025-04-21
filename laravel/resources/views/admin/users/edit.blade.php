@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-4 py-2" required>
        </div>

        <div class="mb-4">
    <label for="password" class="block text-gray-700">Contraseña</label>
    <input type="password" name="password" class="w-full p-2 border rounded" placeholder="Deja en blanco si no deseas cambiarla">
</div>

<div class="mb-4">
    <label for="password_confirmation" class="block text-gray-700">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" class="w-full p-2 border rounded">
</div>

        <div>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        </div>
    </form>
@endsection
