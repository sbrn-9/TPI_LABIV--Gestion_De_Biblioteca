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
        Libro::create(['titulo' => 'El Resplandor','autor' => 'Stephen King','descripcion' => 'Una novela de terror psicológico', 'codigo' => '001','cantidad' => 5,  'disponibles' => 5, 'categoria_id' => $terror,]);
        Libro::create(['titulo' => 'El Código Da Vinci',  'autor' => 'Dan Brown',   'descripcion' => 'Un thriller sobre un misterio religioso', 'codigo' => '002', 'cantidad' => 7,'disponibles' => 7,  'categoria_id' => $thriller, ]);
        Libro::create(['titulo' => 'Cien Años de Soledad',  'autor' => 'Gabriel García Márquez',   'descripcion' => 'Una novela épica sobre la familia Buendía','codigo' => '003','cantidad' => 3,'disponibles' => 3,  'categoria_id' => $novela, ]);
        Libro::create(['titulo' => 'Deportes para Todos','autor' => 'Juan Pérez',    'descripcion' => 'Una guía sobre deportes accesibles',   'codigo' => '004',   'cantidad' => 10, 'disponibles' => 10,'categoria_id' => $deportes, ]);
        Libro::create(['titulo' => 'Matemáticas Básicas','autor' => 'María Sánchez',    'descripcion' => 'Un libro educativo sobre matemáticas',   'codigo' => '005',   'cantidad' => 8, 'disponibles' => 8, 'categoria_id' => $educativo, ]);
        Libro::create(['titulo' => 'Cuentos para Niños', 'autor' => 'Ana López',  'descripcion' => 'Cuentos infantiles para todas las edades',   'codigo' => '006',   'cantidad' => 15, 'disponibles' => 15,  'categoria_id' => $infantil, ]);
        Libro::create(['titulo' => 'Dune', 'autor' => 'Frank Herbert', 'descripcion' => 'Una saga de ciencia ficción sobre el desierto de Arrakis',   'codigo' => '007',   'cantidad' => 4, 'disponibles' => 4,'categoria_id' => $cienciaFiccion, ]);
        Libro::create(['titulo' => 'La República','autor' => 'Platón',   'descripcion' => 'Un tratado filosófico sobre la justicia',   'codigo' => '008',   'cantidad' => 6,   'disponibles' => 6,'categoria_id' => $filosofia, ]);
        Libro::create([
            'titulo' => 'Codigo Limpio',
            'autor' => 'Robert C. Martin',
            'descripcion' => 'Manual de Estilo para desarrollo ágil de Software',
            'codigo' => '123',
            'cantidad' => 25,
            'disponibles' => 25, // Asumo que 1 es disponible, 0 no disponible
            'categoria_id' => $educativo,
            'calificacion' => 4.1,
            'editorial' => 'Anaya Multimedia',
            'fecha_publicacion' => '2012-07-19',
            'idioma' => 'Español',
            'numero_paginas' => 561
        ]);

        $harryPotter = [
            [
                'titulo' => 'Harry Potter y la Piedra Filosofal',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Primer libro de la serie Harry Potter, donde comienza la historia del joven mago.',
                'codigo' => 'HP001',
                'cantidad' => 30,
                'disponibles' => 30,
                'categoria_id' => $novela,
                'calificacion' => 4.8,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '1997-06-26',
                'idioma' => 'Español',
                'numero_paginas' => 223
            ],
            [
                'titulo' => 'Harry Potter y la Cámara Secreta',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Segundo libro de la serie Harry Potter, donde Harry enfrenta nuevos peligros en Hogwarts.',
                'codigo' => 'HP002',
                'cantidad' => 28,
                'disponibles' => 28,
                'categoria_id' => $novela,
                'calificacion' => 4.7,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '1998-07-02',
                'idioma' => 'Español',
                'numero_paginas' => 251
            ],
            [
                'titulo' => 'Harry Potter y el Prisionero de Azkaban',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Tercer libro de la serie Harry Potter, donde Harry se enfrenta a Sirius Black.',
                'codigo' => 'HP003',
                'cantidad' => 27,
                'disponibles' => 27,
                'categoria_id' => $novela,
                'calificacion' => 4.9,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '1999-07-08',
                'idioma' => 'Español',
                'numero_paginas' => 317
            ],
            [
                'titulo' => 'Harry Potter y el Cáliz de Fuego',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Cuarto libro de la serie Harry Potter, donde Harry participa en el Torneo de los Tres Magos.',
                'codigo' => 'HP004',
                'cantidad' => 26,
                'disponibles' => 26,
                'categoria_id' => $novela,
                'calificacion' => 4.8,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '2000-07-08',
                'idioma' => 'Español',
                'numero_paginas' => 636
            ],
            [
                'titulo' => 'Harry Potter y la Orden del Fénix',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Quinto libro de la serie Harry Potter, donde Harry enfrenta mayores desafíos.',
                'codigo' => 'HP005',
                'cantidad' => 25,
                'disponibles' => 25,
                'categoria_id' => $novela,
                'calificacion' => 4.6,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '2003-06-21',
                'idioma' => 'Español',
                'numero_paginas' => 766
            ],
            [
                'titulo' => 'Harry Potter y el Misterio del Príncipe',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Sexto libro de la serie Harry Potter, donde Harry descubre más sobre Voldemort.',
                'codigo' => 'HP006',
                'cantidad' => 29,
                'disponibles' => 29,
                'categoria_id' => $novela,
                'calificacion' => 4.8,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '2005-07-16',
                'idioma' => 'Español',
                'numero_paginas' => 607
            ],
            [
                'titulo' => 'Harry Potter y las Reliquias de la Muerte',
                'autor' => 'J.K. Rowling',
                'descripcion' => 'Séptimo y último libro de la serie Harry Potter, donde concluye la batalla contra Voldemort.',
                'codigo' => 'HP007',
                'cantidad' => 24,
                'disponibles' => 24,
                'categoria_id' => $novela,
                'calificacion' => 4.9,
                'editorial' => 'Bloomsbury Publishing',
                'fecha_publicacion' => '2007-07-21',
                'idioma' => 'Español',
                'numero_paginas' => 607
            ],
        ];

        foreach ($harryPotter as $libro) {
            Libro::create($libro);
        }

        $programacion = [
            [
                'titulo' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'autor' => 'Robert C. Martin',
                'descripcion' => 'Guía para escribir código limpio y mantener buenas prácticas de desarrollo.',
                'codigo' => 'PRG001',
                'cantidad' => 15,
                'disponibles' => 15,
                'categoria_id' => $educativo,
                'calificacion' => 4.7,
                'editorial' => 'Prentice Hall',
                'fecha_publicacion' => '2008-08-11',
                'idioma' => 'Español',
                'numero_paginas' => 464
            ],
            [
                'titulo' => 'The Pragmatic Programmer: Your Journey to Mastery',
                'autor' => 'Andrew Hunt, David Thomas',
                'descripcion' => 'Libro clásico que ofrece una guía sobre cómo pensar y trabajar como un programador profesional.',
                'codigo' => 'PRG002',
                'cantidad' => 20,
                'disponibles' => 20,
                'categoria_id' => $educativo,
                'calificacion' => 4.9,
                'editorial' => 'Addison-Wesley Professional',
                'fecha_publicacion' => '1999-10-20',
                'idioma' => 'Español',
                'numero_paginas' => 352
            ],
            [
                'titulo' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'autor' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
                'descripcion' => 'Referencia fundamental sobre patrones de diseño en el desarrollo de software orientado a objetos.',
                'codigo' => 'PRG003',
                'cantidad' => 10,
                'disponibles' => 10,
                'categoria_id' => $educativo,
                'calificacion' => 4.8,
                'editorial' => 'Addison-Wesley Professional',
                'fecha_publicacion' => '1994-10-31',
                'idioma' => 'Español',
                'numero_paginas' => 395
            ],
            [
                'titulo' => 'Refactoring: Improving the Design of Existing Code',
                'autor' => 'Martin Fowler',
                'descripcion' => 'Libro sobre cómo mejorar el diseño de código existente mediante refactorización.',
                'codigo' => 'PRG004',
                'cantidad' => 18,
                'disponibles' => 18,
                'categoria_id' => $educativo,
                'calificacion' => 4.6,
                'editorial' => 'Addison-Wesley Professional',
                'fecha_publicacion' => '1999-07-08',
                'idioma' => 'Español',
                'numero_paginas' => 431
            ],
            [
                'titulo' => 'JavaScript: The Good Parts',
                'autor' => 'Douglas Crockford',
                'descripcion' => 'Guía sobre los aspectos más importantes y buenos del lenguaje JavaScript.',
                'codigo' => 'PRG005',
                'cantidad' => 12,
                'disponibles' => 12,
                'categoria_id' => $educativo,
                'calificacion' => 4.3,
                'editorial' => 'O\'Reilly Media',
                'fecha_publicacion' => '2008-05-01',
                'idioma' => 'Español',
                'numero_paginas' => 176
            ],
            [
                'titulo' => 'You Don’t Know JS: Scope & Closures',
                'autor' => 'Kyle Simpson',
                'descripcion' => 'Parte de la serie que explora los conceptos más importantes de JavaScript en profundidad.',
                'codigo' => 'PRG006',
                'cantidad' => 14,
                'disponibles' => 14,
                'categoria_id' => $educativo,
                'calificacion' => 4.5,
                'editorial' => 'O\'Reilly Media',
                'fecha_publicacion' => '2014-07-01',
                'idioma' => 'Español',
                'numero_paginas' => 98
            ],
        ];

        foreach ($programacion as $libro) {
            Libro::create($libro);
        }
    }
}
