<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Categoria;
use App\Services\ImgBBService;

class LibroController extends Controller
{
    protected $imgBBService;

    public function __construct(ImgBBService $imgBBService)
    {
        $this->imgBBService = $imgBBService;
    }

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
        $validated = $request->validated();
        
        // Asignar el mismo valor de cantidad a disponibles
        $validated['disponibles'] = $validated['cantidad'];

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen')) {
            $imageUrl = $this->imgBBService->uploadImage($request->file('imagen'));
            if ($imageUrl) {
                $validated['img_url'] = $imageUrl;
            } else {
                return back()->withErrors(['imagen' => 'Error al subir la imagen'])->withInput();
            }
        }

        Libro::create($validated);

        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return view('libros.show',['libro' => $libro]);
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
        $validated = $request->validated();

        // Manejar la subida de la imagen si se proporciona una nueva
        if ($request->hasFile('imagen')) {
            $imageUrl = $this->imgBBService->uploadImage($request->file('imagen'));
            if ($imageUrl) {
                $validated['img_url'] = $imageUrl;
            } else {
                return back()->withErrors(['imagen' => 'Error al subir la imagen'])->withInput();
            }
        }

        $libro->update($validated);
        
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
