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
        Schema::table('libros', function (Blueprint $table) {
            $table->decimal('calificacion', 3, 1)->nullable();
            $table->string('editorial')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->string('idioma')->nullable();
            $table->integer('numero_paginas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropColumn('calificacion');
            $table->dropColumn('editorial');
            $table->dropColumn('fecha_publicacion');
            $table->dropColumn('idioma');
            $table->dropColumn('numero_paginas');
        });
    }
};
