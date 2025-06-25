<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /* Este archivo funciona como un filtro que puede ejecutar tareas como autenticación, validación, registro y modificación de solicitudes.*/ 
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role !== $role) {
        return response()->json([
            "message"=> "Acceso denegado. Sólo para" . $role
            ], 403);
        }
        return $next($request);
    }
}
