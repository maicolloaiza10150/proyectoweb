<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\File;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Limpiar tabla antes de insertar (opcional)
        Card::truncate();

        $cards = [];

        // Obtener todos los usuarios
        $users = User::all();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $card = Card::create([
                    'descripcion' => 'Tarjeta de ' . $user->name,
                    'saldo' => rand(100, 1000),
                    'user_id' => $user->id,
                ]);

                // Guardar para exportarlo al JSON
                $cards[] = [
                    'descripcion' => $card->descripcion,
                    'saldo' => $card->saldo,
                    'user_id' => $card->user_id,
                ];
            }
        }

        // Guardar en cards.json
        $jsonPath = database_path('data/cards.json');
        File::ensureDirectoryExists(dirname($jsonPath));
        File::put($jsonPath, json_encode($cards, JSON_PRETTY_PRINT));
    }
}
