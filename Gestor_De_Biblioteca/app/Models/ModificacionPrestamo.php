<?php

namespace App\Models;

use App\Enums\TipoModificacion;
use App\Enums\EstadoModificacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModificacionPrestamo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'modificaciones_prestamo';
    protected $fillable = [
        'prestamo_id',
        'tipo',
        'estado',
        'nueva_fecha_prestamo',
        'nueva_fecha_devolucion',
    ];

    protected $casts = [
        'tipo' => TipoModificacion::class,
        'estado' => EstadoModificacion::class,
        'nueva_fecha_prestamo' => 'date',
        'nueva_fecha_devolucion' => 'date',
    ];

    /**
     * Get the prestamo that owns the ModificacionPrestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class,'prestamo_id');
    }
}
