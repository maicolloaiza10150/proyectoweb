@extends('layouts.app')

@section('content')
    <h1>Detalle del Producto</h1>

    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
    <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock }}</p>

    <a href="{{ route('productos.index') }}">Volver a la lista</a>
@endsection