<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Categoria;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::all();

        return view('libros.index', ['libros' => $libros]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('libros.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibroRequest $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'codigo' => 'required|string|unique:libros,codigo',
            'cantidad' => 'required|integer',
            'disponibilidad' => 'required|integer',
            'categoria' => 'required|exists:categorias,nombre',
        ]);


        Libro::create($validated);

        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return view('libros.libro',['libro' => $libro]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        $categorias = Categoria::all();
        return view('libros.edit', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibroRequest $request, Libro $libro)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'codigo' => 'required|string|unique:libros,codigo,'. $libro->id,
            'cantidad' => 'required|integer',
            'disponibilidad' => 'required|integer',
            'categoria' => 'required|exists:categorias,nombre',
        ]);

        $libro->update([
            'titulo' => $validated['titulo'],
            'autor' => $validated['autor'],
            'descripcion' => $validated['descripcion'],
            'codigo' => $validated['codigo'],
            'cantidad' => $validated['cantidad'],
            'disponibilidad' => $validated['disponibilidad'],
            'categoria' => $validated['categoria'],
        ]);
        return redirect()->route('libros.index')->with('success', 'Libro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro Eliminado');
    }
}
