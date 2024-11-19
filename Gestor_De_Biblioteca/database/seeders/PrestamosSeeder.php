<?php

namespace Database\Seeders;

use App\Enums\EstadoPrestamo;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ana = User::where('name', 'like', '%Ana%')->first();
        $luis = User::where('name', 'like', '%Luis%')->first();
        $carmen = User::where('name', 'like', '%Carmen%')->first();
        $jorge = User::where('name', 'like', '%Jorge%')->first();
        $lucia = User::where('name', 'like', '%Lucia%')->first();

        $prestamos =[
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' => $ana->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' => $ana->id
            ],
            [
                'estado' => EstadoPrestamo::Pendiente->value,
                'fecha_prestamo' => '2024-11-15',
                'fecha_devolucion' => '2024-11-20',
                'cliente' =>    $ana->id
            ],
            [
                'estado' => 1,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' => 7
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' =>    $ana->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' =>    $ana->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-15',
                'cliente' =>    $ana->id
            ],
            [
                'estado' => EstadoPrestamo::Pendiente->value,
                'fecha_prestamo' => '2024-11-22',
                'fecha_devolucion' => '2024-11-29',
                'cliente' => $luis->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-20',
                'fecha_devolucion' => '2024-08-22',
                'cliente' => $luis->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-08-15',
                'fecha_devolucion' => '2024-08-19',
                'cliente' => $luis->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-09-05',
                'fecha_devolucion' => '2024-09-08',
                'cliente' => $jorge->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-09-12',
                'fecha_devolucion' => '2024-09-13',
                'cliente' => $jorge->id
            ],
            [
                'estado' => EstadoPrestamo::Activo->value,
                'fecha_prestamo' => '2024-11-16',
                'fecha_devolucion' => '2024-11-30',
                'cliente' =>    $jorge->id
            ],
            [
                'estado' => EstadoPrestamo::Activo->value,
                'fecha_prestamo' => '2024-11-15',
                'fecha_devolucion' => '2024-11-20',
                'cliente' => $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-09-31',
                'fecha_devolucion' => '2024-10-15',
                'cliente' => $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-10-18',
                'fecha_devolucion' => '2024-10-19',
                'cliente' =>  $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-10-19',
                'fecha_devolucion' => '2024-09-20',
                'cliente' => $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-10-22',
                'fecha_devolucion' => '2024-10-23',
                'cliente' => $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Cerrado->value,
                'fecha_prestamo' => '2024-10-26',
                'fecha_devolucion' => '2024-10-30',
                'cliente' => $lucia->id
            ],
            [
                'estado' => EstadoPrestamo::Activo->value,
                'fecha_prestamo' => '2024-11-19',
                'fecha_devolucion' => '2024-11-24',
                'cliente' => $lucia->id
            ]
        ];
        $prestamosDeCarmen =[
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' =>    $carmen->id
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' =>    $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' =>    $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' =>    $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-10',
            'fecha_devolucion' => '2024-08-12',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-20',
            'fecha_devolucion' => '2024-08-22',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-19',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-09-05',
            'fecha_devolucion' => '2024-09-08',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-09-12',
            'fecha_devolucion' => '2024-09-13',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-09-16',
            'fecha_devolucion' => '2024-09-18',
            'cliente' =>    $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-09-19',
            'fecha_devolucion' => '2024-09-29',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-09-31',
            'fecha_devolucion' => '2024-10-15',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-10-18',
            'fecha_devolucion' => '2024-10-19',
            'cliente' =>  $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-10-19',
            'fecha_devolucion' => '2024-09-20',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-10-22',
            'fecha_devolucion' => '2024-10-23',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Cerrado->value,
            'fecha_prestamo' => '2024-10-26',
            'fecha_devolucion' => '2024-10-30',
            'cliente' => $carmen->id
        ],
        [
            'estado' => EstadoPrestamo::Pendiente->value,
            'fecha_prestamo' => '2024-11-24',
            'fecha_devolucion' => '2024-11-30',
            'cliente' => $carmen->id
        ],

    ];


        foreach ($prestamos as $prestamo) {
            Prestamo::create($prestamo);
        }
        foreach ($prestamosDeCarmen as $prestamo) {
            Prestamo::create($prestamo);
        }
    }
}
