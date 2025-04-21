@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%; background-color: #f8f9fa; border-radius: 8px;">
            <h2 class="text-center mb-4">Crear Producto</h2>

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nombre del Producto</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ingresa el nombre del producto">
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-12 mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" placeholder="Ingresa una descripción del producto"></textarea>
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" required placeholder="Cantidad disponible">
                    </div>

                    <!-- Precio -->
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" name="price" step="0.01" class="form-control" required placeholder="Ingresa el precio del producto">
                    </div>

                    <!-- Categoría -->
                    <div class="col-md-12 mb-3">
                        <label for="category_id" class="form-label">Categoría</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-12 mb-3">
                        <label for="status_id" class="form-label">Estado</label>
                        <select name="status_id" class="form-select" required>
                            <option value="">Selecciona un estado</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Imagen -->
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Imagen del Producto</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
@endsection
