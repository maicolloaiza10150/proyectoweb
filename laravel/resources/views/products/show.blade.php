@extends('layouts.app')

@section('content')
    <h2>Product Details</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $product->name }}</li>
        <li class="list-group-item"><strong>Stock:</strong> {{ $product->stock }}</li>
        <li class="list-group-item"><strong>Price:</strong> ${{ $product->price }}</li>
        <li class="list-group-item"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $product->status->descripcion ?? 'N/A' }}</li>
        <li class="list-group-item">
            <strong>Image:</strong><br>
            @if ($product->image)
                <img src="data:image/jpeg;base64,{{ $product->image }}" alt="Product Image" style="max-width: 300px; height: auto;" class="mt-2">
            @else
                <p>No image available.</p>
            @endif
        </li>
    </ul>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
