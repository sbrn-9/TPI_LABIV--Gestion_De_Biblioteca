<?php

namespace App\Models;

use App\Enums\TipoDetalle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleModificacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'detalles_modificacion_libros';
    protected $fillable = [
        'modificacion_id',
        'libro_id',
        'nueva_cantidad',
        'tipo',
    ];
    protected $casts = [
      'tipo' => TipoDetalle::class,
    ];

    /**
     * Get the Modificacion that owns the DetalleModificacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Modificacion(): BelongsTo
    {
        return $this->belongsTo(ModificacionPrestamo::class, 'modificacion_id');
    }

    /**
     * Get the libro that owns the DetalleModificacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}
