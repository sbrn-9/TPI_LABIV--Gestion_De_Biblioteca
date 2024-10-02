<?php

namespace Database\Seeders;

use App\Models\User;
use App\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MiUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        ***************************COMPLETAR CON TUS DATOS*******************************
        */
        User::factory()->create([
                'name' => 'Juan Manuel Fernandez',
                'email' => 'juanma08072003@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => TipoUsuario::Admin->value,
            ]);

    }
}
