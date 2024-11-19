<?php

namespace Database\Seeders;

use App\Enums\TipoUsuario;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $clientes = [
            [
                'name' => 'Ana García',
                'email' => 'anagarcia@example.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5551234567',
                'address' => 'Calle Falsa 123, Ciudad A',
                'role' => TipoUsuario::Cliente->value,
            ],
            [
                'name' => 'Luis Martínez',
                'email' => 'luis.martinez@example.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5552345678',
                'address' => 'Avenida Siempre Viva 742, Ciudad B',
                'role' => TipoUsuario::Cliente->value            ],
            [
                'name' => 'Carmen Pérez',
                'email' => 'carmen.perez@example.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5553456789',
                'address' => 'Calle del Sol 456, Ciudad C',
                'role' => TipoUsuario::Cliente->value
            ],
            [
                'name' => 'Jorge Ramírez',
                'email' => 'jorge.ramirez@example.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5554567890',
                'address' => 'Boulevard Principal 789, Ciudad D',
                'role' => TipoUsuario::Cliente->value
            ],
            [
                'name' => 'Lucía Torres',
                'email' => 'lucia.torres@example.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5555678901',
                'address' => 'Avenida Central 101, Ciudad E',
                'role' => TipoUsuario::Cliente->value
            ],
        ];


        foreach ($clientes as $cliente) {
            User::create($cliente);
        }

    }
}
