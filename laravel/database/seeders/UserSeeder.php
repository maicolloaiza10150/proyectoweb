<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/users.json'));
        $users = json_decode($json, true);

        foreach ($users as $user) {
            $password = $user['password'];

            // Si la contraseña no está encriptada, la encriptamos
            if (!str_starts_with($password, '$2y$')) {
                $password = Hash::make($password);
            }

            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => $password,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
