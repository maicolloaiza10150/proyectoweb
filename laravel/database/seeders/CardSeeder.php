<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\User;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Asegurarse de que haya al menos un usuario
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                // Crear una tarjeta por usuario con un saldo aleatorio y descripción
                Card::create([
                    'descripcion' => 'Tarjeta de ' . $user->name, // Descripción
                    'saldo' => rand(100, 1000), // Saldo aleatorio entre 100 y 1000
                    'user_id' => $user->id // Asociar la tarjeta al usuario
                ]);
            }
        }
    }
}
