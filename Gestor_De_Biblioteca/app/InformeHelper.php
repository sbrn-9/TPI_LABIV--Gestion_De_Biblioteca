<?php

namespace App;

use App\Models\Libros_Prestados;
use Illuminate\Support\Facades\DB;

class InformeHelper
{
    /**
     * Create a new class instance.
     */
    public static function getTopCategorias()
    {
        $names = [];
        $values = [];
        $topCategorias = DB::select(
            'select c.nombre as categoria, sum(lp.cantidad) as total_libros_prestados
            from categorias c
            join libros l on c.id = l.categoria_id
            join libros_prestados lp on l.id = lp.libro_id
            group by c.id, c.nombre
            order by total_libros_prestados desc
            limit :li;', ['li' => 3]);
        foreach($topCategorias as $index => $value){
            $names[$index] = $value->categoria;
            $values[$index] = $value->total_libros_prestados;
        }
        return ['names' => $names,
                'values' => $values];
    }
    public static function getTopUsers()
    {
        $names = [];
        $values = [];

        $topUsers = DB::select(
            'select u.id, u.name, count(*) as total_prestamos
            from users u join prestamos p on u.id = p.cliente
            where u.role = 1
            group by u.id, u.name
            order by total_prestamos desc
            limit 6');
        foreach($topUsers as $index => $value){
            $names[$index] = $value->name;
            $values[$index] = $value->total_prestamos;
        }

        return ['names' => $names,
                'values' => $values];
    }
    public static function getTopLibros()
    {
        $topLibros = DB::select(
            'select l.titulo, l.autor, l.calificacion, count(*) as total_prestamos
                            from libros_prestados lp join libros l on lp.libro_id = l.id
                            group by l.titulo, l.autor, l.calificacion
                            order by total_prestamos desc
                            limit 5');

        return $topLibros;
    }
    public static function getCategoriasConMasExistencias()
    {
        $names = [];
        $values = [];
        $categorias = DB::select(
            'select c.nombre as categoria, sum(l.cantidad) as existencias
            from categorias c join libros l on c.id = l.categoria_id
            group by categoria
            order by existencias desc');
        foreach($categorias as $index => $value){
            $names[$index] = $value->categoria;
            $values[$index] = $value->existencias;
        }
        return ['names' => $names,
                'values' => $values];
    }
    public static function getBestLibro()
    {
        $bestLibro = DB::select(
            'select *
            from libros
            where calificacion =(select max(l.calificacion)
                                from libros l)');
        return $bestLibro[0];
    }
    public static function getLargestLibro(){
        $largestLibro = DB::select(
            'select *
            from libros l
            where numero_paginas = (select max(l.numero_paginas)
                                    from libros l)');
        return $largestLibro[0];
    }
    public static function getOldestLibro(){
        $oldestLibro = DB::select(
            'select *
            from libros l
            where l.fecha_publicacion = (select min(fecha_publicacion)
                                        from libros)');
        return $oldestLibro[0];
    }
}
