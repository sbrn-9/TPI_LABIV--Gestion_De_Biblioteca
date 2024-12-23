<?php

namespace App\Http\Controllers;

use App\Enums\EstadoPrestamo;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __invoke(Request $request)
    {
            $alerts = null;

            if (Auth::check() && Auth::user()->role->isAdmin()) {
                $alerts = Prestamo::where('estado', EstadoPrestamo::Activo->value)->where('fecha_devolucion', '>', today(),
                'and', '<', (today()->addDays(3)))->get();
                return view('welcome', ['alerts' => $alerts]);
            }
            elseif(Auth::check() && auth::user()->role->isCliente())
            {
                $alerts = Prestamo::where('estado', EstadoPrestamo::Activo->value)->where('cliente', auth::user()->id)
                ->where('fecha_devolucion', '>', today(), 'and', '<', (today()->addDays(3)))->get();
                return view('welcome', ['alerts' => $alerts]);
            }

            return view('welcome', ['alerts' => $alerts]);

    }
}
