<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Enums\TipoUsuario;


use Closure;

use function Laravel\Prompts\error;

class IsRoleAdmin
{
    public function handle($request, Closure $next)
    {

        if (Auth::user()->role->value === TipoUsuario::Admin->value) {
            return $next($request); // Permitimos la continuación solo si es admin
        }

        return error("Usted no es admin"); // Redirige a YouTube

    }
}
