<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'estado',
        'fecha_prestamo',
        'fecha_devolucion'
    ];

    protected function casts(): array
    {
        return [
            'fecha_prestamo' => 'datetime',
            'fecha_devolucion' => 'datetime',
            'fecha_modificación' => 'datetime',
            'fecha_cancelación' => 'datetime',
        ];
    }

    public function admin_cancelador()
    {
        return $this->belongsTo(User::class, 'admin_cancelador');
    }

    public function admin_modificador()
    {
        return $this->belongsTo(User::class, 'admin_modificador');
    }

    public function admin_eliminador()
    {
        return $this->belongsTo(User::class, 'admin_eliminador');
    }

    public function clienteche()
    {
        return $this->belongsTo(User::class, 'cliente');
    }

    /**
     * Get all of the librosPrestados for the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function libros(): BelongsToMany
     {
         return $this->belongsToMany(Libro::class, 'libros__prestados', 'prestamo_id', 'libro_id');
     }
}
