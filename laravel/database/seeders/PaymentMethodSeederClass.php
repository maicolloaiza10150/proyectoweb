<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeederClass extends Seeder  
{
    public function run(): void
    {
        $metodos = ['Efectivo', 'Tarjeta', 'Transferencia'];

        foreach ($metodos as $metodo) {
            PaymentMethod::create(['descripcion' => $metodo]);
        }
    }
}
