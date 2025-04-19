@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <form action="#" method="POST">
        <!-- Aquí va el formulario de pago -->
        <div class="space-y-4">
            <div>
                <label for="card_number" class="block text-sm font-semibold text-gray-700">Número de tarjeta</label>
                <input type="text" id="card_number" name="card_number" class="mt-2 block w-full border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            <div>
                <label for="expiry_date" class="block text-sm font-semibold text-gray-700">Fecha de expiración</label>
                <input type="text" id="expiry_date" name="expiry_date" class="mt-2 block w-full border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            <div>
                <label for="cvv" class="block text-sm font-semibold text-gray-700">CVV</label>
                <input type="text" id="cvv" name="cvv" class="mt-2 block w-full border border-gray-300 rounded-md px-4 py-2" required>
            </div>
        </div>

        <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
            Pagar
        </button>
    </form>
@endsection
