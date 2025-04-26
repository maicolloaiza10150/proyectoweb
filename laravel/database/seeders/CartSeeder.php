<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use Illuminate\Support\Facades\File;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar carrito anterior
        Cart::truncate();

        $jsonPath = database_path('data/carts.json');

        if (!File::exists($jsonPath)) {
            $this->command->warn('El archivo carts.json no existe.');
            return;
        }

        $cartData = json_decode(File::get($jsonPath), true);

        foreach ($cartData as $item) {
            Cart::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        $this->command->info('Carrito cargado desde carts.json');
    }
}
