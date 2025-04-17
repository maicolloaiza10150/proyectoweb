@extends('layouts.app')

@section('content')
    <h2>Product Details</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $product->name }}</li>
        <li class="list-group-item"><strong>Stock:</strong> {{ $product->stock }}</li>
        <li class="list-group-item"><strong>Price:</strong> ${{ $product->price }}</li>
        <li class="list-group-item"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $product->status->name ?? 'N/A' }}</li>
    </ul>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
