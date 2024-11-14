<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestamos =[
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-15',
            'cliente' => 7
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-10',
            'fecha_devolucion' => '2024-08-12',
            'cliente' => 8
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-20',
            'fecha_devolucion' => '2024-08-22',
            'cliente' => 8
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-08-15',
            'fecha_devolucion' => '2024-08-19',
            'cliente' => 8
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-05',
            'fecha_devolucion' => '2024-09-08',
            'cliente' => 10
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-12',
            'fecha_devolucion' => '2024-09-13',
            'cliente' => 10
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-16',
            'fecha_devolucion' => '2024-09-18',
            'cliente' => 10
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-19',
            'fecha_devolucion' => '2024-09-29',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-31',
            'fecha_devolucion' => '2024-10-15',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-10-18',
            'fecha_devolucion' => '2024-10-19',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-10-19',
            'fecha_devolucion' => '2024-09-20',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-10-22',
            'fecha_devolucion' => '2024-10-23',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-10-26',
            'fecha_devolucion' => '2024-10-30',
            'cliente' => 11
        ],
        [
            'estado' => 1,
            'fecha_prestamo' => '2024-09-19',
            'fecha_devolucion' => '2024-09-23',
            'cliente' => 11
        ],

    ];


        foreach ($prestamos as $prestamo) {
            Prestamo::create($prestamo);
        }
    }
}
