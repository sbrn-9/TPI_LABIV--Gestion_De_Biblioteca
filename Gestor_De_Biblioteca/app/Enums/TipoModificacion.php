<?php

namespace App\Enums;

enum TipoModificacion: string
{
    case ModLibros = 'mod_libros';
    case CambioFecha = 'cambio_fecha';

}

enum TipoDetalle: string
{
    case ModCantidad = 'mod_cantidad';
    case AgregarLibro = 'agregar_libro';
    case QuitarLibro = 'quitar_libro';
}
