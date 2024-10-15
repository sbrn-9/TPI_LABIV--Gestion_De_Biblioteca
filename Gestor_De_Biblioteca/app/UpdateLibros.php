<?php

namespace App;
use App\Models\Libro;
use App\Models\Libros_Prestados;

class UpdateLibros
{
    static function DescontarLibros($libro_id, $cantidad)
    {
        $libro = Libro::find($libro_id);
        $libro->disponibles -= $cantidad;
        $libro->save();
    }

    static function DevolverLibros($libro_id, $cantidad)
    {
        $libro = Libro::find($libro_id);
        $libro->disponibles += $cantidad;
        $libro->save();
    }
}
