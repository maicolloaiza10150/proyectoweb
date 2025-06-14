<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodos = ['Efectivo', 'Tarjeta', 'Transferencia'];

        foreach ($metodos as $metodo) {
            MetodoPago::create(['descripcion' => $metodo]);
    }
  }
}