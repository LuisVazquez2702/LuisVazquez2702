<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValiAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->tipo_usuario == 1){
            if($request->user()->id > 1){
                $nombre = 'Lo siento! Acceso solo para Administradores Root';
                abort(403, $nombre);
            }
        }
        
        return $next($request);
    }
}
