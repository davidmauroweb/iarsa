<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class mantenimiento
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->rol=="adm" || auth()->user()->rol=="mnt")
        {
        return $next($request);
        };

        return redirect()->route('home')->with('mensajeNo','Acceso para Mantenimiento.');
    }
}
