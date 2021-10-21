<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\AlimentosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\Profile_2;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\pedidosController;
use App\Http\Controllers\ReportesController;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pruebaIMG', function () {
});



Route::get('/uttec', function () {
    /*//return "Hola Uttec";
	//Crear nuevo registro
	$nuevoNegocio = new Negocio();

	//Actualizar
	$nuevoNegocio = Negocio::find(69);
	$nuevoNegocio->nombre = "PruebaActualización";

	$nuevoNegocio->descripcion = "PruebaDescripción";
	$nuevoNegocio->categoria = "PruebaCategoria";
	$nuevoNegocio->giro = "PruebaGiro";
	$nuevoNegocio->telefono = "PruebaTelefono";
	$nuevoNegocio->id_usuario = 12;
	$nuevoNegocio->etiquetas = "PruebaEtiquetas";
	//Crear y Actualizar
	$nuevoNegocio->save();

	//Eliminar Registro
	//$nuevoNegocio->delete();
	$nuevoNegocio = Negocio::all();
	return $nuevoNegocio;*/
	/*	$nuevoUsuario = new User();
        $nuevoUsuario->name = 'Prueba';
        $nuevoUsuario->email = 'luisa@gmail.com';
        $nuevoUsuario->password = Hash::make('123456');
        $nuevoUsuario->tipo_usuario = 1;
        $nuevoUsuario->save();*/

		/*$newCarrito = new Carrito();
        $newCarrito->fecha_inicio = date("Y/m/d");
        $newCarrito->pagado = 0;
        $newCarrito->id_usuario = Auth::user()->id;

        $newCarrito->save();
*/
	});
Auth::routes();

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
		Route::group(['middleware' => 'valUser'], function() {
			Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
			Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
			Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
			Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
			Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
			Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
			Route::get('map', function () {return view('pages.maps');})->name('map');
			Route::get('icons', function () {return view('pages.icons');})->name('icons');
			Route::get('table-list', function () {return view('pages.tables');})->name('table');
			Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
			//Negocios CRUD
			Route::get("/negocios", [NegocioController::class, 'vista'])->name("crud_negocios");
			Route::get("/lista_negocios", [NegocioController::class, 'listar']);
			Route::post("/edit_negocio", [NegocioController::class, 'editar']);
			Route::post("/guardar_negocio", [NegocioController::class, 'guardar']);
			Route::delete("/eliminar_negocio/{id_negocio}", [NegocioController::class, 'eliminar']);

			//Alimentos CRUD
			Route::get("/alimentos", [AlimentosController::class, 'vista'])->name("crud_alimentos");
            Route::get("/alimentos_listar", [AlimentosController::class, 'listar']);

            Route::get("/alimentos_listar2", [AlimentosController::class, 'inicio']);
			Route::post("/alimentos_editar", [AlimentosController::class, 'editar']);
			Route::post("/alimentos_guardar", [AlimentosController::class, 'guardar']);
			Route::delete("/alimentos_eliminar/{id_alimento}", [AlimentosController::class, 'eliminar']);

			Route::get("/verIMG/{id_alimento}", [AlimentosController::class, 'verArchivos']);

			//CLIENTES CRUD
			Route::get("/clientes", [ClientesController::class, 'vista'])->name("crud_clientes");
			Route::get("/clientes_listar", [ClientesController::class, 'listar']);
			Route::post("/clientes_editar", [ClientesController::class, 'editar']);
			Route::post("/clientes_guardar", [ClientesController::class, 'guardar']);
			Route::delete("/clientes_eliminar/{id_cliente}", [ClientesController::class, 'eliminar']);

			//Direcciones
			Route::get("/direcciones", [DireccionController::class, 'vista']);
			Route::get("/direcciones_listar", [DireccionController::class, 'listar']);
			Route::post("/direcciones_editar", [DireccionController::class, 'editar']);
			Route::post("/direcciones_guardar", [DireccionController::class, 'guardar']);
			Route::delete("/direcciones_eliminar/{id_direccion}", [DireccionController::class, 'eliminar']);
			Route::group(['middleware' => 'valAdmin'], function() {
			//Usuarios
				Route::get("/usuarios", [UsuariosController::class, 'vista'])->name("crud_usuarios");
				Route::get("/usuarios_listar", [UsuariosController::class, 'listar']);
				Route::post("/usuarios_editar", [UsuariosController::class, 'editar']);
				Route::post("/usuarios_guardar", [UsuariosController::class, 'guardar']);
				Route::delete("/usuarios_eliminar/{id_usuario}", [UsuariosController::class, 'eliminar']);

			});

			Route::get("/inicio", [InicioController::class, 'vista'])->name('inicio');


            //Carrito
            Route::get("/carrito", [CarritoController::class, 'index'])->name('carrito');
            Route::post("/newItem", [ItemController::class, 'newItem']);
            Route::delete("/deleteItem/{id}", [ItemController::class, 'deleteItem']);
            Route::get("/items", [ItemController::class, 'itemSelectUser']);
            Route::get("/total", [ItemController::class, 'total']);

            //REPORTE
            Route::get("/reporte", [ReportesController::class, 'reporteItem']);
            Route::get("/compilar", [ReportesController::class, 'compilarItem']);


	});
	Route::group(['middleware' => 'pasado'], function() {
		Route::get('/registroDual', function () {
			return view('pages.registroDual');
		})->name('registroDual');

		Route::post("/clienteGuardar", [ClientesController::class, 'guardar2'])->name('validacionClient');
		Route::post("/negocioGuardar", [NegocioController::class, 'guardar2'])->name('validacionNegocio');
	});

	Route::get("/usuarioEspec", [UsuariosController::class, 'usuarioEspec']);

	//Modification of your information
	Route::post("/modificarFotoPerfil",[Profile_2::class, 'foto']);
	Route::post("/nameEmail",[Profile_2::class, 'nameEmail']);
	Route::post("/pModify",[Profile_2::class, 'password']);

	//Pagos
	Route::get("/pagos", function(){return view('pages.pagos');})->name('paginaPagos');
	Route::post("/procesarPagos", [PagoController::class, 'procesar']);
    Route::get("/pagar", [CarritoController::class, 'pagoCarrito']);

    //Pedidos
    Route::get("/pedidos", [pedidosController::class, 'index'])->name('pedidos');
    Route::get("/pendientes", [pedidosController::class, 'pedidosPendientes']);
    Route::get("/enviados", [pedidosController::class, 'pedidosEnviados']);
    Route::get("/entregados", [pedidosController::class, 'pedidosEntregados']);
    Route::get("/enviar/{id}", [pedidosController::class, 'enviar']);
    Route::get("/entregar/{id}", [pedidosController::class, 'entregar']);
});
