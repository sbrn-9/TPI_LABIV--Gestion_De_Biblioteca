<?php

namespace Database\Seeders;

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
            //CategoriaSeeder::class,
            //LibroSeeder::class
            //MiUsuarioSeeder::class
        ]);
    }
}
