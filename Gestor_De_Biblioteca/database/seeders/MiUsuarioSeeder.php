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
                'name' => 'Guadalupe Sosa Fachinotti',
                'email' => 'guadafachinotti@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => TipoUsuario::Admin->value,
            ]);

    }
}
