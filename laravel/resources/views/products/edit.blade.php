@extends('layouts.app')

@section('content')
    <h2>Edit Product</h2>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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

        <div class="mb-3">
            <label>Current Image</label><br>
            @if ($product->image)
                <img src="data:image/jpeg;base64,{{ $product->image }}" alt="Current Image" style="max-width: 300px; height: auto;" class="mb-2">
            @else
                <p>No image available.</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
