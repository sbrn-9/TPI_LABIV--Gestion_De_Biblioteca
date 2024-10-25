<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsRoleCliente;
use App\Http\Middleware\IsRoleAdmin;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::resource('libros',LibroController::class)->withTrashed();
    Route::resource('prestamos',PrestamoController::class)->withTrashed();
});

Route::middleware('auth')->middleware(IsRoleAdmin::class)->group(function () {
    Route::resource('libros', LibroController::class)->withTrashed();

});

Route::middleware('auth')->middleware(IsRoleCliente::class)->group(function () {

    Route::get('/cliente/libros', [LibroController::class, 'index'])->name('libros.index');
});

require __DIR__.'/auth.php';
