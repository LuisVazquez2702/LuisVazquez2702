<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
{
            public function vista(){
                return view('pages.usuarios');
            }

            public function listar(){
                return User::all();
            }

            public function usuarioEspec(Request $request){
                //if($request->user()->password=='$2y$10$7DAnuvpcYp6Yh3R1WYRN4eCKwGEzZqmAcnTyWP15UR4Av0EzhW6DW'){                    
                return User::find($request->user()->id);
            }
             
            public function guardar(Request $request){
                $nuevoUsuario = new User();
                $nuevoUsuario->name = $request->name;
                $nuevoUsuario->email = $request->email;
                $password = $request->password;
                $nuevoUsuario->password = Hash::make($password);
                $nuevoUsuario->tipo_usuario = $request->tipo_usuario;
                $nuevoUsuario->foto = $request->file('foto')->store('users','public');
                $nuevoUsuario->save();
            }
            public function editar(Request $request){
                $usuario = User::find($request->id);
                $usuario->name = $request->name;
                $usuario->email = $request->email;
                /*$password = $request->password;
                $usuario->password = Hash::make($password);*/   
                $usuario->tipo_usuario = $request->tipo_usuario;
                if($request->file('foto')!=null){
                    $usuario->foto = $request->file('foto')->store('users','public');
                }

                $usuario->save();
            }
            public function eliminar($id_usuario){
                if($id_usuario>2){
                    $usuario = User::find($id_usuario);
                    $usuario->delete();
                }
            }
}
