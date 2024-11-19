<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsRoleCliente;
use App\Http\Middleware\IsRoleAdmin;

Route::get('/', welcomeController::class)->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/libro/buscar-libros', [LibroController::class, 'searchBooks'])->name('libro.buscar-libros');
    Route::resource('libros', LibroController::class)->withTrashed();
    Route::resource('prestamos', PrestamoController::class)->withTrashed();

});

Route::middleware('auth')->middleware(IsRoleAdmin::class)->group(function () {
    Route::patch('/prestamos/{id}/estado', [PrestamoController::class, 'updateEstado'])->name('prestamos.updateEstado');
    Route::get('/informes/negocio', [InformeController::class, 'negocio'])->name('informes.negocio');
    Route::get('/informes/control', [InformeController::class, 'control'])->name('informes.control');
    Route::resource('users', UserController::class);
    Route::patch('/prestamos/{id}/activar', [PrestamoController::class, 'activarPrestamo'])->name('prestamos.activar');
    Route::patch('/prestamos/{id}/cerrar', [PrestamoController::class, 'cerrarPrestamo'])->name('prestamos.cerrar');
    Route::patch('/prestamos/{id}/cancelar', [PrestamoController::class, 'cancelarPrestamo'])->name('prestamos.cancelar');
});

Route::middleware('auth')->middleware(IsRoleCliente::class)->group(function () {
    Route::get('/cliente/libros', [LibroController::class, 'index'])->name('cliente-libros.index');
    Route::get('/cliente/libros/{libro}', [PrestamoController::class, 'show'])->name('cliente-libros.show');
    Route::get('/cliente/mis-prestamos', [PrestamoController::class, 'index'])->name('cliente-prestamos.index');
    Route::get('/cliente/mis-prestamos/{prestamo}', [PrestamoController::class, 'show'])->name('cliente-prestamos.show');
    Route::patch('/cliente/prestamos/{id}/devolucion', [PrestamoController::class, 'update'])->name('cliente-prestamos.update');
    Route::delete('/cliente/prestamos/{id}', [PrestamoController::class, 'destroy'])->name('cliente-prestamos.destroy');
    Route::post('/cliente/prestamos', [PrestamoController::class, 'store'])->name('cliente-prestamos.store');
    Route::patch('/cliente/prestamos/{id}/cancelar', [PrestamoController::class, 'cancelarPrestamo'])->name('cliente-prestamos.cancelar');
});

require __DIR__ . '/auth.php';
