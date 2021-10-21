<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function vista(){
        return view("pages.clientes");
    }
    public function listar(){
        return Clientes::all();
    }
    public function editar(Request $request){
        $cliente = Clientes::find($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        if($request->file('foto')!=null){
            $cliente->foto = $request->file('foto')->store('clientes','public');
        }
        $cliente->save();
    }
    public function guardar(Request $request){
	    $nuevoCliente = new Clientes();
        $nuevoCliente->nombre = $request->nombre;
        $nuevoCliente->apellidos = $request->apellidos;
        $nuevoCliente->telefono = $request->telefono;;
        $nuevoCliente->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevoCliente->foto = $request->file('foto')->store('clientes','public');
        $nuevoCliente->save();
    }
    public function guardar2(Request $request){
	    $nuevoCliente = new Clientes();        
        $nuevoCliente->id_usuario = $request->user()->id;
        $nuevoCliente->nombre = $request->nombre;
        $nuevoCliente->apellidos = $request->apellidos;
        $nuevoCliente->telefono = $request->telefono;;
        $nuevoCliente->fecha_nacimiento = $request->fecha_nacimiento;
        $nuevoCliente->foto = $request->file('foto')->store('clientes','public');
        

        $userModify = User::find($request->user()->id);
        $userModify->tipo_usuario = 3;
        $userModify->foto = $nuevoCliente->foto;
        $userModify->save();
        $nuevoCliente->save();
    }
    public function eliminar($id_cliente){
        $cliente = Clientes::find($id_cliente);
        $cliente->delete();
    }
}
