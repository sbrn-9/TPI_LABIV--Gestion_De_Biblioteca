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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('descripcion', 2000);
            $table->string('codigo')->unique();
            $table->integer('cantidad')->default(1);
            $table->integer('disponibles');
            $table->string('img_url', 500)->nullable();
            $table->decimal('calificacion', 3, 1)->nullable();
            $table->string('editorial')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->string('idioma')->nullable();
            $table->integer('numero_paginas')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')
                ->cascadeOnUpdate()
                ->noActionOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
