<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Enums\TipoUsuario;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class IsRoleCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd(Auth::user()->role);

        if (Auth::user()->role->isCliente()) {
            return $next($request); // Permitimos la continuación solo si es cliente
        }


            return error("Usted no es cliente"); // Redirige a YouTube

    }
}
