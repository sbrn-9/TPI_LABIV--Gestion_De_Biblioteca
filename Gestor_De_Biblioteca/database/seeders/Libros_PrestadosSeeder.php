<?php

namespace Database\Seeders;

use App\Enums\EstadoPrestamo;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use App\Models\Libros_Prestados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Libros_PrestadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Ana Luis Carmen Jorge Lucia
     */
    public function run(): void
    {
        $ana = User::where('name', 'like', '%Ana%')->first();
        $luis = User::where('name', 'like', '%Luis%')->first();
        $carmen = User::where('name', 'like', '%Carmen%')->first();
        $jorge = User::where('name', 'like', '%Jorge%')->first();
        $lucia = User::where('name', 'like', '%Lucia%')->first();

        $anaPrestamos = Prestamo::where('cliente', '=', $ana->id)->get();
        $luisPrestamos = Prestamo::where('cliente', '=', $luis->id)->get();
        $carmenPrestamos = Prestamo::where('cliente', '=', $carmen->id)->get();
        $jorgePrestamos = Prestamo::where('cliente', '=', $jorge->id)->get();
        $luciaPrestamos = Prestamo::where('cliente', '=', $lucia->id)->get();

        foreach ($anaPrestamos as $index => $prestamo) {
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%El Resplandor%')->first()->id,
                'cantidad' => 4,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Dune%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Cien%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
        }
        foreach ($luisPrestamos as $index => $prestamo) {
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Clean%')->first()->id,
                'cantidad' => 5,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Design%')->first()->id,
                'cantidad' => 5,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Refactoring%')->first()->id,
                'cantidad' => 5,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
        }
        foreach ($jorgePrestamos as $index => $prestamo) {
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%La Rep%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
        }
        foreach ($luciaPrestamos as $index => $prestamo) {
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%JavaScript%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Know JS%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
        }
        foreach ($carmenPrestamos as $index => $prestamo) {
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Piedra%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Cámara%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Prisionero%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
            Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Fuego%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Orden%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Misterio%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);Libros_Prestados::create([
                'prestamo_id' => $prestamo->id,
                'libro_id' => Libro::where('titulo', 'like', '%Reliquia%')->first()->id,
                'cantidad' => 1,
                'estado' => EstadoPrestamo::Cerrado->value,
            ]);
        }

    }
}
