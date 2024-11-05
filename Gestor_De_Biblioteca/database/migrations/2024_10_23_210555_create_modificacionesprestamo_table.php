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
        Schema::create('modificaciones_prestamo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prestamo_id');
            $table->foreign('prestamo_id')->references('id')->on('prestamos')
            ->noActionOnDelete()->cascadeOnUpdate();
            $table->Enum('tipo', ['mod_libro', 'cambio_fecha']);
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->date('nueva_fecha_prestamo');
            $table->date('nueva_fecha_devolucion');
            $table->string('coment_cliente')->nullable();
            $table->string('coment_admin')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modificaciones_prestamo');
    }
};
