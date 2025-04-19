@extends('layouts.app')

@section('content')
    <h2>Editar Producto</h2>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ $product->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Categoría</label>

            
            <select name="category_id" class="form-select" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        
        <div class="mb-3">
            <label>Estado</label>
            <select name="status_id" class="form-select" required>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}"
    @if ($product->status_id == $status->id) selected @endif>
    {{ $status->descripcion }}
</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen actual</label><br>
            @if ($product->image)
                <img src="data:image/jpeg;base64,{{ $product->image }}" alt="Imagen actual" style="max-width: 300px; height: auto;" class="mb-2">
            @else
                <p>No hay imagen disponible.</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Subir nueva imagen</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
@endsection
