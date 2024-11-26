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

    public static function getAdminWeeklyCancelations($adminId)
    {
        $cancelations = DB::select(
            'select count(*) as total_cancelations
            from prestamos
            where admin_cancelador = :adminId and estado = 4 and YEARWEEK(canceled_at, 1) = YEARWEEK(CURDATE(), 1)',
            ['adminId' => $adminId]
        );

        return $cancelations[0]->total_cancelations ?? 0;
    }

    public static function getAdminWeeklyActivations($adminId)
    {
        $activations = DB::select(
            'select count(*) as total_activations
            from prestamos
            where admin_activador = :adminId and estado = 1 and YEARWEEK(updated_at, 1) = YEARWEEK(CURDATE(), 1)',
            ['adminId' => $adminId]
        );

        return $activations[0]->total_activations ?? 0;
    }

    public static function getAdminWeeklyRejections($adminId)
    {
        $rejections = DB::select(
            'select count(*) as total_rejections
            from prestamos
            where admin_eliminador = :adminId and estado = 2 and YEARWEEK(updated_at, 1) = YEARWEEK(CURDATE(), 1)',
            ['adminId' => $adminId]
        );

        return $rejections[0]->total_rejections ?? 0;
    }

    public static function getMonthlyAverages()
{
    $averages = DB::select(
        'select
            avg(cancelaciones) as avg_cancelations,
            avg(activaciones) as avg_activations,
            avg(cierres) as avg_closures
        from (
            select
                count(case when estado = 4 then 1 end) as cancelaciones,
                count(case when estado = 1 then 1 end) as activaciones,
                count(case when estado = 2 then 1 end) as cierres
            from prestamos
            group by YEAR(updated_at), MONTH(updated_at)
        ) as monthly_data'
    );

    $result = $averages[0];

    return [
        'avg_cancelations' => ceil($result->avg_cancelations),
        'avg_activations' => ceil($result->avg_activations),
        'avg_closures' => ceil($result->avg_closures)
    ];
}




}
