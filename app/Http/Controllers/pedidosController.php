<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class pedidosController extends Controller
{
    //
    public function index(){
        return view('pages.pedidos');
    }
    public function pedidosPendientes(){
        if(Auth::user()->tipo_usuario>1){
                return Clientes::join('users', 'users.id','=','clientes.id_usuario')
                        ->join('direccion','direccion.id_cliente','=','clientes.id')
                        ->join('carrito','users.id','=','carrito.id_usuario')
                        ->join('item','carrito.id','=','item.id_carrito')
                        ->join('alimentos','item.id_alimento','=','alimentos.id')
                        ->join('negocios','alimentos.id_negocio','=','negocios.id')
                        ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
                        ->where('negocios.id_usuario','=',Auth::user()->id)
                        ->where('enviado','=',0)
                        //->orderBy('item.id', 'asc')
                        ->get();
        }else{
            return Clientes::join('users', 'users.id','=','clientes.id_usuario')
            ->join('direccion','direccion.id_cliente','=','clientes.id')
            ->join('carrito','users.id','=','carrito.id_usuario')
            ->join('item','carrito.id','=','item.id_carrito')
            ->join('alimentos','item.id_alimento','=','alimentos.id')
            ->join('negocios','alimentos.id_negocio','=','negocios.id')
            ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
            ->where('enviado','=',0)
           // ->orderBy('item.id', 'asc')
            ->get();
        }
        /*
        SELECT * FROM clientes INNER JOIN users ON clientes.id_usuario = users.id
            INNER JOIN direccion ON direccion.id_cliente = clientes.id
            INNER JOIN carrito ON users.id = carrito.id_usuario
            INNER JOIN item ON carrito.id = item.id_carrito
			INNER JOIN alimentos ON item.id_alimento = alimentos.id
			INNER JOIN negocios ON alimentos.id_negocio = negocios.id*/
    }
    public function pedidosEnviados(){
        if(Auth::user()->tipo_usuario>1){
            return Clientes::join('users', 'users.id','=','clientes.id_usuario')
            ->join('direccion','direccion.id_cliente','=','clientes.id')
            ->join('carrito','users.id','=','carrito.id_usuario')
            ->join('item','carrito.id','=','item.id_carrito')
            ->join('alimentos','item.id_alimento','=','alimentos.id')
            ->join('negocios','alimentos.id_negocio','=','negocios.id')
            ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
            ->where('negocios.id_usuario','=',Auth::user()->id)
            ->where('enviado','=',1)
            ->where('entregado','=',0)
            ->get();
        }else{
            return Clientes::join('users', 'users.id','=','clientes.id_usuario')
            ->join('direccion','direccion.id_cliente','=','clientes.id')
            ->join('carrito','users.id','=','carrito.id_usuario')
            ->join('item','carrito.id','=','item.id_carrito')
            ->join('alimentos','item.id_alimento','=','alimentos.id')
            ->join('negocios','alimentos.id_negocio','=','negocios.id')
            ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
            ->where('enviado','=',1)
            ->where('entregado','=',0)
            ->get();

        }
        /*SELECT * FROM alimentos
			INNER JOIN negocios ON alimentos.id_negocio = negocios.id
			INNER JOIN Item ON alimentos.id = Item.id_alimento
			WHERE entregado = 0 AND enviado=1;*/
    }
    public function pedidosEntregados(){
        if(Auth::user()->tipo_usuario>1){
            return Clientes::join('users', 'users.id','=','clientes.id_usuario')
            ->join('direccion','direccion.id_cliente','=','clientes.id')
            ->join('carrito','users.id','=','carrito.id_usuario')
            ->join('item','carrito.id','=','item.id_carrito')
            ->join('alimentos','item.id_alimento','=','alimentos.id')
            ->join('negocios','alimentos.id_negocio','=','negocios.id')
            ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
            ->where('negocios.id_usuario','=',Auth::user()->id)
            ->where('enviado','=',1)
            ->where('entregado','=',1)
            ->get();

        }else{
            return Clientes::join('users', 'users.id','=','clientes.id_usuario')
            ->join('direccion','direccion.id_cliente','=','clientes.id')
            ->join('carrito','users.id','=','carrito.id_usuario')
            ->join('item','carrito.id','=','item.id_carrito')
            ->join('alimentos','item.id_alimento','=','alimentos.id')
            ->join('negocios','alimentos.id_negocio','=','negocios.id')
            ->select("alimentos.*",'item.*','item.id as idItem', 'direccion.*', 'users.name')
            ->where('enviado','=',1)
            ->where('entregado','=',1)
            ->get();


        }
        /*SELECT * FROM alimentos
			INNER JOIN negocios ON alimentos.id_negocio = negocios.id
			INNER JOIN Item ON alimentos.id = Item.id_alimento
			WHERE entregado = 1 AND enviado=1;*/
    }
    public function enviar($id){
        $envi = Item::find($id);
        $envi->enviado = 1;
        $envi->save();
    }
    public function entregar($id){
        $enviado = Item::find($id);
        $enviado->entregado = 1;
        $enviado->save();
    }
}
