@extends('layouts.app')

@section('content')
    <h1>Editar Producto</h1>

    @if ($errors->any())
        <div>
            <strong>¡Oops!</strong> Hay algunos errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required><br><br>

        <label>Descripción:</label>
        <textarea name="descripcion">{{ $producto->descripcion }}</textarea><br><br>

        <label>Precio:</label>
        <input type="text" name="precio" value="{{ $producto->precio }}" required><br><br>

        <label>Stock:</label>
        <input type="number" name="stock" value="{{ $producto->stock }}" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="{{ route('productos.index') }}">Volver a la lista</a>
@endsection