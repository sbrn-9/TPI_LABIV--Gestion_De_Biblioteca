<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [ 'nombre'];

    /**
     * The libro that belong to the Categoria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libros(): HasMany
    {
        return $this->HasMany(Libro::class, 'categoria_id');
    }
}
