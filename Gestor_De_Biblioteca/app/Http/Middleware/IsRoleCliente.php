<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Enums\TipoUsuario;
use Illuminate\Support\Facades\Auth;

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


            return redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ'); // Redirige a YouTube

    }
}
