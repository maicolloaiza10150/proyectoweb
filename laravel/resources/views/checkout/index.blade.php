@extends('layouts.app')

@section('content')
<div class="container mt-8">

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Resumen de tu Carrito</h2>

    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="table-auto w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">Juego</th>
                    <th class="px-6 py-3 text-left">Precio</th>
                    <th class="px-6 py-3 text-left">Cantidad</th>
                    <th class="px-6 py-3 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4">{{ $item->product->name }}</td>
                        <td class="px-6 py-4">${{ number_format($item->product->price, 2) }}</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4">${{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100">
                    <th colspan="3" class="px-6 py-4 text-right text-lg">Total a pagar:</th>
                    <th class="px-6 py-4 text-lg font-bold">${{ number_format($total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        <a href="{{ route('checkout.create') }}" class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition-all duration-300">
            Proceder al pago
        </a>
    </div>

</div>
@endsection
