<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::factory()->create(['nombre' => 'Deportes']);
        Categoria::factory()->create(['nombre' => 'Terror']);
        Categoria::factory()->create(['nombre' => 'Thriller']);
        Categoria::factory()->create(['nombre' => 'Novela']);
        Categoria::factory()->create(['nombre' => 'Educativo']);
        Categoria::factory()->create(['nombre' => 'Infantil']);
        Categoria::factory()->create(['nombre' => 'Filosofía']);
        Categoria::factory()->create(['nombre' => 'Ciencia Ficcion']);
    }
}
