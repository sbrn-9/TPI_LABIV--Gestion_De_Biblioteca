<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * Get the libro associated with the Libros_Prestados
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function libro(): HasOne
    {
        return $this->hasOne(Libro::class,'id', 'libro_id');
    }
}
