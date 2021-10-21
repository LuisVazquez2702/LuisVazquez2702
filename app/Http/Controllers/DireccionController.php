<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    //
    public function vista(){
        return view("pages.direccion");
    }
    public function listar(){
        return Direccion::all();
    }
    public function editar(Request $request){
        $direccion = Direccion::find($request->id);
        $direccion->id_cliente = $request->id_cliente;
        $direccion->calle = $request->calle;
        $direccion->exterior = $request->exterior;
        $direccion->interior = $request->interior;
        $direccion->codigoPostal = $request->codigoPostal;
        $direccion->localidad = $request->localidad;
        $direccion->estado = $request->estado;
        $direccion->colonia = $request->colonia;

        $direccion->save();

    }
    public function guardar(Request $request){
	    $nuevaDireccion = new Direccion();
        $nuevaDireccion->id_cliente = $request->id_cliente;
        $nuevaDireccion->calle = $request->calle;
        $nuevaDireccion->exterior = $request->exterior;
        $nuevaDireccion->interior = $request->interior;
        $nuevaDireccion->codigoPostal = $request->codigoPostal;
        $nuevaDireccion->localidad = $request->localidad;
        $nuevaDireccion->estado = $request->estado;
        $nuevaDireccion->colonia = $request->colonia;
        $nuevaDireccion->save();
    }
    
    public function eliminar($id_direccion){
        $direccion = Direccion::find($id_direccion);
        $direccion->delete();
    }
}
