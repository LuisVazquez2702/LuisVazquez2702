<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //
    public function itemSelectUser(){
        $items = DB::table('item')
        ->join('carrito','item.id_carrito','=','carrito.id')
        ->join('alimentos','item.id_alimento', '=', 'alimentos.id')
        ->where('carrito.id_usuario','=', Auth::user()->id)
        ->where('carrito.pagado','=', 0)
        ->select('item.id as id_item','item.id_alimento', 'item.id_carrito', 'item.cantidad'
        ,'alimentos.*'
        ,'carrito.*'
        ,DB::raw('cantidad*precio as precioTotal'))->get();
        return $items;
    }

    public function total(){
        $total = DB::table('item')
        ->join('carrito','item.id_carrito','=','carrito.id')
        ->join('alimentos','item.id_alimento', '=', 'alimentos.id')
        ->where('carrito.id_usuario','=', Auth::user()->id)
        ->where('carrito.pagado','=', 0)
        ->select(DB::raw('sum(item.cantidad*alimentos.precio) as precioTotal'))->get();
        return $total;
    }
    public function newItem(Request $request){
            $item = new Item();
            $item->id_alimento = $request->id;
            $item->id_carrito = CarritoController::veriCarrito()->id;
            $item->cantidad = $request->cantidad;
            $item->save();

    }
    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();
    }

    public function pagadoItem($id){
        DB::table('item')
              ->where('id_carrito', $id)
              ->update(['entregado' => 0, 'enviado'=>0]);
    }
}
