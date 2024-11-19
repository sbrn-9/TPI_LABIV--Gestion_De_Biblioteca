<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\TipoUsuario;
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
        User::factory()->create([
                'name' => 'Emilio Puljiz',
                'email' => 'profe@admin.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5551234567',
                'address' => 'Calle de Admin, Ciudad A',
                'role' => TipoUsuario::Admin->value,
            ]);
        User::factory()->create([
                'name' => 'Emilio Puljiz',
                'email' => 'profe@cliente.com',
                'password' => Hash::make('12345678'),
                'phone_number' => '5551234567',
                'address' => 'Calle de Cliente, Ciudad A',
                'role' => TipoUsuario::Cliente->value,
            ]);
    }
}
