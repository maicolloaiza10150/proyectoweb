@extends('layouts.app')
@section('content')
    <h2>Create Product</h2>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_id">Status</label>
            <select name="status_id" class="form-select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image">Product Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-success">Save</button>
    </form>
@endsection