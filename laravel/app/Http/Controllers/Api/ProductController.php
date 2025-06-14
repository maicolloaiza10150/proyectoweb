<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    



public function show(Product $product)
{
    return view('admin.products.show', compact('product'));
}

    public function index()
    {
        $products = Product::with(['category', 'status'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('admin.products.create', compact('categories', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageData = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image));
        }

        $product = Product::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'image' => $imageData,
        ]);

        $jsonPath = base_path('database/data/products.json');
        $jsonData = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];

        $jsonData[] = [
            'id' => $product->id,
            'name' => $product->name,
            'descripcion' => $product->descripcion,
            'stock' => $product->stock,
            'price' => $product->price,
            'category_id' => $product->category_id,
            'status_id' => $product->status_id,
            'image' => $product->image,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];

        file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $statuses = Status::all();
        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageData = $product->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image));
        }

        $product->update([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'image' => $imageData,
        ]);

        $jsonPath = base_path('database/data/products.json');
        $jsonData = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];

        foreach ($jsonData as &$item) {
            if ($item['id'] == $product->id) {
                $item['descripcion'] = $product->descripcion;
                $item['name'] = $product->name;
                $item['stock'] = $product->stock;
                $item['price'] = $product->price;
                $item['category_id'] = $product->category_id;
                $item['status_id'] = $product->status_id;
                $item['image'] = $product->image;
                $item['updated_at'] = $product->updated_at;
                break;
            }
        }

        file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }
    public function shop()
{
    $products = Product::all();
    return view('shop.index', compact('products'));
}

    public function destroy(Product $product)
    {
        $jsonPath = base_path('database/data/products.json');
        $jsonData = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];

        $jsonData = array_filter($jsonData, fn($item) => $item['id'] != $product->id);

        file_put_contents($jsonPath, json_encode(array_values($jsonData), JSON_PRETTY_PRINT));

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
