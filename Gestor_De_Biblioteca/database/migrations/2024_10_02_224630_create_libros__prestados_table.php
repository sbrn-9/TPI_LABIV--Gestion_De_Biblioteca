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
        Schema::create('libros__prestados', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('estado');
            $table->unsignedBigInteger('prestamo_id');
            $table->foreign('prestamo_id')->references('id')->on('prestamos')
            ->noActionOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('libro_id');
            $table->foreign('libro_id')->references('id')->on('libros')
            ->noActionOnDelete()->cascadeOnUpdate();
            $table->integer('cantidad');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros__prestados--resources');
    }
};
