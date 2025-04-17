@extends('layouts.app')

@section('content')
    <h2>Edit Product</h2>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status_id" class="form-select" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ $product->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
