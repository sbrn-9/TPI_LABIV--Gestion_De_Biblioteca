<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Enums\EstadoPrestamo;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use App\Models\Libro;
use App\Models\Libros_Prestados;
use App\UpdateLibros;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth::user()->role->isAdmin())
        {
            $prestamos = Prestamo::all();
        }
        elseif(auth::user()->role->isCliente())
        {
            $prestamos = Prestamo::where('cliente', auth::user()->id)->get();
        }
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
    public function store(StorePrestamoRequest $request): RedirectResponse
    {
        //valida en StorePrestamoRequest y llega aqui
        $validatedData = $request->validated();

        //logica estado
        if($validatedData['fecha_prestamo'] > today()){
            $estado = EstadoPrestamo::Pendiente->value;
        }else{
            $estado = EstadoPrestamo::Activo->value;}

        //crea el prestamo en la bd con los campos necesarios
        $prestamo = Prestamo::create([
            'estado' => $estado,
            'fecha_prestamo' => $validatedData['fecha_prestamo'],
            'fecha_devolucion' => $validatedData['fecha_devolucion'],
            'cliente' => auth::user()->id, //el usuario que esta activo
        ]);

        //crea los libros prestados
        foreach($validatedData['libros'] as $libro){//recorre el array de libros

            if($libro['cantidad'] != null //que tengan un valor en cantidad
                && $libro['cantidad'] > 0 ){ //que sea mayor a 0

            Libros_Prestados::create([//crea el registro
                'estado' => $estado,
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
        $prestamoLibrosInfo = Libros_Prestados::where('prestamo_id', $prestamo->id)->get();
        return view('prestamos.show', ['prestamo' => $prestamo, 'prestamoLibrosInfo' => $prestamoLibrosInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        $prestamoLibrosInfo = Libros_Prestados::where('prestamo_id', $prestamo->id)->get();
        return view('prestamos.edit',
        ['prestamo' => $prestamo,
               'prestamoLibrosInfo' => $prestamoLibrosInfo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestamoRequest $request, Prestamo $prestamo): RedirectResponse
    {

        $validatedData = $request->validated();

         if($validatedData['fecha_prestamo'] > today()){
             $estado= EstadoPrestamo::Pendiente->value;
         }
         else{
             $estado = EstadoPrestamo::Activo->value;
         }

         $prestamo->update([
             'fecha_prestamo' => $validatedData['fecha_prestamo'],
             'fecha_devolucion' => $validatedData['fecha_devolucion'],
             'estado' => $estado,
             'admin_modificador' => auth::user()->id,
         ]);

        $librosPrestados = Libros_Prestados::where('prestamo_id', $prestamo->id)->get();

        foreach($librosPrestados as $index => $registro){

            if((int)$validatedData['libros'][$index]['cantidad'] == 0 || (int)$validatedData['libros'][$index]['cantidad'] == null){
                UpdateLibros::DevolverLibros($registro->libro_id, $registro->cantidad);
                $registro->delete();
            }
            else{
                $cantidadAnterior = (int)$registro['cantidad'];
                $registro->update([
                    'estado' => $estado,
                    'libro_id' => $validatedData['libros'][$index]['libro_id'], // id del libro actual
                    'cantidad' => $validatedData['libros'][$index]['cantidad'], // cantidad pedida
                ]);

                UpdateLibros::CambiarLibros((int)$registro['libro_id'],
                                            $cantidadAnterior,
                                            (int)$validatedData['libros'][$index]['cantidad']);
            }
        }

        return redirect()->route('prestamos.index')
        ->with('success', 'Prestamo Actualizado Correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        $libros = Libros_Prestados::where('prestamo_id', $prestamo->id)->get();

        foreach($libros as $info){
            UpdateLibros::DevolverLibros($info->libro_id, $info->cantidad);
            $info->delete();
        }

        return redirect()->route('prestamos.index')->with('success', 'Prestamo Eliminado');
    }

    public function updateEstado(Request $request, $id): RedirectResponse
    {
        $prestamo = Prestamo::findOrFail($id);

        $estado = match ($request->estado) {
            'cerrado' => EstadoPrestamo::Cerrado->value,
            'activo' => EstadoPrestamo::Activo->value,
            'cancelado' => EstadoPrestamo::Cancelado->value,
            default => EstadoPrestamo::Pendiente->value,
        };

        $prestamo->estado = $estado;
        $prestamo->save();

        return redirect()->route('prestamos.index')
            ->with('success', 'Estado del préstamo: actualizado correctamente');
    }


}
