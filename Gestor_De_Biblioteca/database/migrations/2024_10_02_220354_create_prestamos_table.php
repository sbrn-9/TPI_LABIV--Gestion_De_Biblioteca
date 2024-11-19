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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('estado');
            $table->dateTime('fecha_prestamo');
            $table->dateTime('fecha_devolucion');

            $table->unsignedbigInteger('cliente');
            $table->foreign('cliente')->references('id')->on('users')
            ->noActionOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('admin_activador')->nullable();
            $table->foreign('admin_activador')->references('id')->on('users')
            ->noActionOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('admin_cancelador')->nullable();;
            $table->foreign('admin_cancelador')->references('id')->on('users')
            ->noActionOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('admin_eliminador')->nullable();;
            $table->foreign('admin_eliminador')->references('id')->on('users')
            ->noActionOnDelete()->cascadeOnUpdate();

            $table->timestamps();
            $table->timestamp('canceled_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
