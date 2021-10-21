<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocio;
use App\Models\User;

class NegocioController extends Controller
{
    public function vista(){
        return view('pages.negocios');
    }
    public function listar(){
        return Negocio::all();
    }
    public function editar(Request $request){
        $negocio = Negocio::find($request->id);
        $negocio->nombre = $request->nombre;
        $negocio->descripcion = $request->descripcion;
        $negocio->categoria = $request->categoria;
        $negocio->giro = $request->giro;
        $negocio->telefono = $request->telefono;
        $negocio->etiquetas = $request->etiquetas;
        if($request->file('foto')!=null){
            $negocio->foto = $request->file('foto')->store('negocios','public');
        }
        $negocio->save();

    }
    public function guardar(Request $request){
        /*$rules = [
            "nombre" => "required|min:4",
            "descripcion" => "required|min:4",
            "categoria" => "required|min:4",
            "giro" => "required|min:4",
            "telefono" => "numeric|in:10",
            "etiquetas" => "required|min:10"
        ];

        $detalle_mensaje = [
            "nombre.required" => "Es necesario poner el nombre del negocio",
            "nombre.min" => "Es necesario poner mas de 4 caracteres"
        ];
        $this->validate($request, $rules, $detalle_mensaje);*/
	    $nuevoNegocio = new Negocio();

        $nuevoNegocio->nombre = $request->nombre;
        $nuevoNegocio->descripcion = $request->descripcion;
        $nuevoNegocio->categoria = $request->categoria;
        $nuevoNegocio->giro = $request->giro;
        $nuevoNegocio->telefono = $request->telefono;
        $nuevoNegocio->etiquetas = $request->etiquetas;
        $nuevoNegocio->foto = $request->file('foto')->store('negocios','public');
        $nuevoNegocio->save();
    }
    
    public function guardar2(Request $request){
	    $nuevoNegocio = new Negocio();
        $nuevoNegocio->nombre = $request->nombre;
        $nuevoNegocio->id_usuario = $request->user()->id;
        $nuevoNegocio->descripcion = $request->descripcion;
        $nuevoNegocio->categoria = $request->categoria;
        $nuevoNegocio->giro = $request->giro;
        $nuevoNegocio->telefono = $request->telefono;
        $nuevoNegocio->etiquetas = $request->etiquetas;
        $nuevoNegocio->foto = $request->file('foto')->store('negocios','public');

        $userModify = User::find($request->user()->id);
        $userModify->tipo_usuario = 2;
        $userModify->save();

        $nuevoNegocio->save();
        return view('pages.alimentos');
    }
    public function eliminar($id_negocio){
        $negocio = Negocio::find($id_negocio);
        $negocio->delete();
    }
}
