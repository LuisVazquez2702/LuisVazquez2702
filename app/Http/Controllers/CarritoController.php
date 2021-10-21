<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index(){
        return view('pages.carrito');
    }
    public static function veriCarrito(){
        $carrito = DB::table('carrito')->where('id_usuario','=',Auth::user()->id)->where('pagado','=',0)->first();
        if(empty($carrito)){
            $newCarrito = CarritoController::newCarrito();
            return $newCarrito;
        }else{
            return $carrito;
        }
    }
    public static function newCarrito(){
        $newCarrito = new Carrito();
        $newCarrito->fecha_inicio = date("Y/m/d");
        $newCarrito->pagado = 0;
        $newCarrito->id_usuario = Auth::user()->id;
        $newCarrito->save();
        return $newCarrito;
    }

    public function totalito(){
        $total = DB::table('item')->join('alimentos', 'item.id_alimento', '=', 'alimentos.id')->join('carrito', 'item.id_carrito', '=','carrito.id')->where('id_carrito','=',$carrito->id)->pluck(DB::raw('SUM(alimentos.precio*cantidad) as total'));
        return $total[0];
    }

    public static function pagoCarrito(){
        $carrito = DB::table('carrito')->where('id_usuario','=',Auth::user()->id)->where('pagado','=',0)->first();
        $total = DB::table('item')->join('alimentos', 'item.id_alimento', '=', 'alimentos.id')->join('carrito', 'item.id_carrito', '=','carrito.id')->where('id_carrito','=',$carrito->id)->pluck(DB::raw('SUM(alimentos.precio*cantidad) as total'));
        $modify = Carrito::find($carrito->id);
        $modify->pagado=1;
        $modify->fecha_pago = date("Y/m/d");
        $modify->total =  $total[0];
        $modify->save();
        $items = new ItemController();
        $items->pagadoItem($carrito->id);
    }
}
