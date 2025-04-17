@extends('layouts.app')

@section('content')
    <h1>Crear Producto</h1>

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

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label>
        <textarea name="descripcion"></textarea><br><br>

        <label>Precio:</label>
        <input type="text" name="precio" required><br><br>

        <label>Stock:</label>
        <input type="number" name="stock" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="{{ route('productos.index') }}">Volver a la lista</a>
@endsection