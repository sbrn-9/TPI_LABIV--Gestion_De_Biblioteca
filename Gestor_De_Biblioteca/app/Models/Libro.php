<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'codigo',
        'cantidad',
        'disponibles',
        'categoria_id',
        'img_url',
        'calificacion',
        'editorial',
        'fecha_publicacion',
        'idioma',
        'numero_paginas'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * The prestamos that belong to the Libro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function prestamos(): BelongsToMany
    {
        return $this->belongsToMany(Prestamo::class,'libros_prestados','libro_id', 'prestamo_id');
    }
}
