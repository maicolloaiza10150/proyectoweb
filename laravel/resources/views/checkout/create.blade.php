@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Checkout</h2>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="card_id" class="block text-sm font-medium text-gray-700 mb-1">Seleccionar Tarjeta</label>
            <select name="card_id" id="card_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($cards as $card)
                    <option value="{{ $card->id }}">
                        Tarjeta #{{ $card->id }} - Saldo: ${{ number_format($card->saldo, 2) }}
                    </option>
                @endforeach
            </select>
            @error('card_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="payment_method_id" class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
            <select name="payment_method_id" id="payment_method_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($paymentMethods as $method)
                    <option value="{{ $method->id }}">{{ $method->descripcion }}</option>
                @endforeach
            </select>
            @error('payment_method_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Monto</label>
            <input type="number" name="amount" id="amount" step="0.01" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pon el monto total" value="{{ number_format($totalAmount, 2) }}" readonly>
            @error('amount')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <p class="font-medium text-gray-700">Total a Pagar: ${{ number_format($totalAmount, 2) }}</p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                Confirmar Pago
            </button>
        </div>
    </form>
</div>
@endsection
