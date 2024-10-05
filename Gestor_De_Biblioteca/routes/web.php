<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('libros',LibroController::class)->withTrashed();//Consultar por qué este no me sirvió y me salta error de admin.libro admin undefined
    //Actulización del problema: todas las funciones deben estar apuntando a admin.
    //como se estaba trabajando con la carpeta libros, aparece como que admin. no está definida
    Route::get('/admin/libros', [LibroController::class, 'index'])->name('admin.libros-admin');
});

require __DIR__.'/auth.php';
