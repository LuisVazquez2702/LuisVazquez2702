<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidUsuario
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
        $negocio = DB::select('SELECT id FROM negocios WHERE id_usuario = ?', [$request->user()->id]);
        $cliente = DB::select('SELECT id FROM clientes WHERE id_usuario = ?', [$request->user()->id]);
        if ($request->user()->tipo_usuario != 1) {
            if (empty($cliente) & empty($negocio)) {
                return redirect()->route('registroDual');
            }
        }
        return $next($request);
    }
}
