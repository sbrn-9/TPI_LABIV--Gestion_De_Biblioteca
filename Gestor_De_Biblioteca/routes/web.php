<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsRoleCliente;
use App\Http\Middleware\IsRoleAdmin;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/libro/buscar-libros', [LibroController::class, 'searchBooks'])->name('libro.buscar-libros');
    Route::resource('libros', LibroController::class)->withTrashed();

});

Route::middleware('auth')->middleware(IsRoleAdmin::class)->group(function () {
    Route::resource('prestamos', PrestamoController::class)->withTrashed();
    Route::patch('/prestamos/{id}/estado', [PrestamoController::class, 'updateEstado'])->name('prestamos.updateEstado');
    Route::resource('users', UserController::class); // Agregando rutas de usuarios
});

Route::middleware('auth')->middleware(IsRoleCliente::class)->group(function () {
    Route::get('/cliente/libros', [LibroController::class, 'index'])->name('cliente-libros.index');
    Route::get('/cliente/libros/{libro}', [PrestamoController::class, 'show'])->name('cliente-libros.show');
});

require __DIR__ . '/auth.php';
