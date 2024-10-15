<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use App\Models\Libro;
use App\Models\Libros_Prestados;
use App\UpdateLibros;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::all();
        return view('prestamos.index', ['prestamos' => $prestamos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
        return view('prestamos.create', ['libros' => $libros]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestamoRequest $request)
    {
        //valida en StorePrestamoRequest y llega aqui
        $validatedData = $request->validated();

        //crea el prestamo en la bd con los campos necesarios
        $prestamo = Prestamo::create([
            'estado' => 1,  //estado ya activo
            'fecha_prestamo' => $validatedData['fecha_prestamo'],
            'fecha_devolucion' => $validatedData['fecha_devolucion'],
            'cliente' => auth::user()->id, //el usuario que esta activo
        ]);

        //crea los libros prestados
        foreach($validatedData['libros'] as $libro){//recorre el array de libros

            if($libro['cantidad'] != null //que tengan un valor en cantidad
                && $libro['cantidad'] > 0 ){ //que sea mayor a 0

            Libros_Prestados::create([//crea el registro
                'estado' => 1,
                'prestamo_id' => $prestamo->id, //id del prestamo creado
                'libro_id' => $libro['libro_id'], // id del libro actual
                'cantidad' => $libro['cantidad'], // cantidad pedida
            ]);

            UpdateLibros::DescontarLibros($libro['libro_id'], $libro['cantidad']);
            }
        }


        return redirect()->route('prestamos.index')
        ->with('success', 'El prestamo se ha creado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        return view('prestamos.show', ['prestamo' => $prestamo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamos.edit', ['prestamo' => $prestamo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestamoRequest $request, Prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
