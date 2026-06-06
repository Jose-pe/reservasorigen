<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si el usuario está autenticado y si tiene el rol 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Permite que la petición continúe
        }

        // Si no es admin, puedes redirigirlo o lanzar un error 403 (Prohibido)
        abort(403, 'Acceso denegado. No tienes permisos de administrador.');
        
        // Alternativa: Redirigir al inicio con un mensaje de error
        // return redirect('/')->with('error', 'Acceso denegado.');
    }
}
