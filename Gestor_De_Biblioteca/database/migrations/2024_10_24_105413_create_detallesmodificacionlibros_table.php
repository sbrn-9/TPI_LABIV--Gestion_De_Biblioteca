<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalles_modificacion_libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modificacion_id');
            $table->foreign('modificacion_id')->references('id')->on('modificaciones_prestamo');
            $table->unsignedBigInteger('libro_id');
            $table->foreign('libro_id')->references('id')->on('libros');
            $table->integer('nueva_cantidad')->nullable();
            $table->Enum('tipo', ['mod_cantidad', 'agregar_libro', 'quitar_libro']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_modificacion_libros');
    }
};
