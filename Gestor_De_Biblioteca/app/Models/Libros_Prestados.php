<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libros_Prestados extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'libros_prestados';
    protected $fillable = [
        'libro_id',
        'cantidad',
        'estado',
        'prestamo_id'
    ];


}
