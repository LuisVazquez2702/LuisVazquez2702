<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatosNegocioController extends Controller
{
    public function vista(){
        return view('pages.datosNegocio');
    }
}
