<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        ************************DESCOMENTAR LO DE ABAJO PARA LA PRIMERA VEZ***********************************
        */
        $this->call([
            MiUsuarioSeeder::class,
            CategoriaSeeder::class,
            LibroSeeder::class,
            ClientesSeeder::class,
            PrestamosSeeder::class,
            Libros_PrestadosSeeder::class
        ]);

    }
}
