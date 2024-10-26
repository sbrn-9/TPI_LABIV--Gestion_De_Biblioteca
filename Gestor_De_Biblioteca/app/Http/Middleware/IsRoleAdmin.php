<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Enums\TipoUsuario;


use Closure;

class IsRoleAdmin
{
    public function handle($request, Closure $next)
    {
        dd(Auth::user()->role);

        if (Auth::user()->role->value === TipoUsuario::Admin->value) {
            return $next($request); // Permitimos la continuación solo si es admin
        }

        return redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ'); // Redirige a YouTube

    }
}
