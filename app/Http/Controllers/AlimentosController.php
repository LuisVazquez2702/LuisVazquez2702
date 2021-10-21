<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alimentos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AlimentosController extends Controller
{
    public function vista(){
        return view('pages.alimentos');
    }
    public function listar(Request $request){
        /*if(
        $table->bigIncrements('
        .0');
        )*/
        if($request->user()->tipo_usuario == 1){
            return Alimentos::join('negocios','negocios.id','=','alimentos.id_negocio')
            ->select("alimentos.*",'negocios.nombre as nego_name')
            ->get();
        }

        return Alimentos::join('negocios','negocios.id','=','alimentos.id_negocio')
        ->select("alimentos.*",'negocios.nombre as nego_name')
        ->where('negocios.id_usuario', '=', $request->user()->id)
        ->get();
        //return Alimentos::all();
        //return DB::table('alimentos')
          //  ->leftJoin('negocios', 'alimentos.id_negocio', '=', 'negocios.id')
    }
    public function inicio(){
        return Alimentos::join('negocios','negocios.id','=','alimentos.id_negocio')
            ->select("alimentos.*",'negocios.nombre as nego_name')
            ->get();
    }
    public function guardar(Request $request){
        $nuevoAlimento = new Alimentos();
        $nuevoAlimento->id_negocio=$request->id_negocio;
        $nuevoAlimento->nombre=$request->nombre;
        $nuevoAlimento->porcion=$request->porcion;
        $nuevoAlimento->precio=$request->precio;
        $nuevoAlimento->descripcion=$request->descripcion;
        $nuevoAlimento->foto = $request->file('foto')->store('alimentos','public');

        //Validación si es un tipo negocio el que inserta
        if($request->user()->tipo_usuario == 2){
            $aux = DB::table('negocios')->where('id_usuario', $request->user()->id)->first();
            $nuevoAlimento->id_negocio = $aux->id;
        }
        $nuevoAlimento->save();
    }
    public function editar(Request $request){
        $alimento = Alimentos::find($request->id);
        //$alimento->id_negocio = $request->id_negocio;
        $alimento->nombre = $request->nombre;
        $alimento->porcion = $request->porcion;
        $alimento->precio = $request->precio;
        $alimento->descripcion = $request->descripcion;
        if($request->file('foto')!=null){
            $alimento->foto = $request->file('foto')->store('alimentos','public');
        }

        $alimento->save();
    }
    public function verArchivos($id){
        $alimento = Alimentos::find($id);
        $ruta = 'public/'.$alimento->foto;
        return Storage::download($ruta);
    }
    public function eliminar($id_alimento){
        $alimento = Alimentos::find($id_alimento);
        $alimento->delete();
    }
}
