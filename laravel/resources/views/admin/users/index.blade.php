@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">
                        <!-- Enlaces para editar o eliminar -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Editar</a> |
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
