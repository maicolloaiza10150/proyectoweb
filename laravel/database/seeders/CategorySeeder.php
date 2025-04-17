<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/categories.json'));
        $categorias = json_decode($json, true);

        foreach ($categorias as $categoria) {
            DB::table('categories')->insert([
                'name' => $categoria['name'],
                'status_id' => $categoria['status_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}