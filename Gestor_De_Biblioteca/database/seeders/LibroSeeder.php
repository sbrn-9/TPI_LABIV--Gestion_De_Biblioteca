<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $terror = Categoria::where('nombre', 'Terror')->first()->id;
        $thriller = Categoria::where('nombre', 'Thriller')->first()->id;
        $novela = Categoria::where('nombre', 'Novela')->first()->id;
        $deportes = Categoria::where('nombre', 'Deportes')->first()->id;
        $educativo = Categoria::where('nombre', 'Educativo')->first()->id;
        $infantil = Categoria::where('nombre', 'Infantil')->first()->id;
        $cienciaFiccion = Categoria::where('nombre', 'Ciencia Ficcion')->first()->id;
        $filosofia = Categoria::where('nombre', 'Filosofia')->first()->id;

        // Insertar libros
        Libro::create([
            'titulo' => 'El Resplandor',
            'autor' => 'Stephen King',
            'descripcion' => 'Una novela de terror psicológico',
            'codigo' => '001',
            'cantidad' => 5,
            'disponibles' => 5, // Asumo que 1 es disponible, 0 no disponible
            'categoria_id' => $terror,
        ]);

        Libro::create([
            'titulo' => 'El Código Da Vinci',
            'autor' => 'Dan Brown',
            'descripcion' => 'Un thriller sobre un misterio religioso',
            'codigo' => '002',
            'cantidad' => 7,
            'disponibles' => 7,
            'categoria_id' => $thriller,
        ]);

        Libro::create([
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'descripcion' => 'Una novela épica sobre la familia Buendía',
            'codigo' => '003',
            'cantidad' => 3,
            'disponibles' => 3,
            'categoria_id' => $novela,
        ]);

        Libro::create([
            'titulo' => 'Deportes para Todos',
            'autor' => 'Juan Pérez',
            'descripcion' => 'Una guía sobre deportes accesibles',
            'codigo' => '004',
            'cantidad' => 10,
            'disponibles' => 10,
            'categoria_id' => $deportes,
        ]);

        Libro::create([
            'titulo' => 'Matemáticas Básicas',
            'autor' => 'María Sánchez',
            'descripcion' => 'Un libro educativo sobre matemáticas',
            'codigo' => '005',
            'cantidad' => 8,
            'disponibles' => 8,
            'categoria_id' => $educativo,
        ]);

        Libro::create([
            'titulo' => 'Cuentos para Niños',
            'autor' => 'Ana López',
            'descripcion' => 'Cuentos infantiles para todas las edades',
            'codigo' => '006',
            'cantidad' => 15,
            'disponibles' => 15,
            'categoria_id' => $infantil,
        ]);

        Libro::create([
            'titulo' => 'Dune',
            'autor' => 'Frank Herbert',
            'descripcion' => 'Una saga de ciencia ficción sobre el desierto de Arrakis',
            'codigo' => '007',
            'cantidad' => 4,
            'disponibles' => 4,
            'categoria_id' => $cienciaFiccion,
        ]);

        Libro::create([
            'titulo' => 'La República',
            'autor' => 'Platón',
            'descripcion' => 'Un tratado filosófico sobre la justicia',
            'codigo' => '008',
            'cantidad' => 6,
            'disponibles' => 6,
            'categoria_id' => $filosofia,
        ]);
    }
}
