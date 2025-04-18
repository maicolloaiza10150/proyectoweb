<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('database/data/products.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("Archivo no encontrado: $jsonPath");
            return;
        }

        $products = json_decode(File::get($jsonPath), true);

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['id' => $data['id']],
                [
                    'name' => $data['name'],
                    'stock' => $data['stock'],
                    'price' => $data['price'],
                    'category_id' => $data['category_id'],
                    'status_id' => $data['status_id'],
                    'image' => $data['image'] ?? null,
                    'created_at' => $data['created_at'] ?? now(),
                    'updated_at' => $data['updated_at'] ?? now(),
                ]
            );
        }

        $this->command->info("Productos importados desde el JSON correctamente.");
    }
}
