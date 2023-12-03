<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Esteban Hurtado Blumberg',
            'email' => 'blumbergesteban@gmail.com',
            'password' => bcrypt('1234'), // Asegúrate de encriptar la contraseña
        ]);
        Producto::create([
            'nombre' => 'Leche Pil ',
            'precio_estandar' => 8,
            'precio_minimo' => 7,
            'stock' => 1000,
            'imagen' => 'LechePil.jpg',
        ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
