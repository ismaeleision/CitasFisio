<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
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

//Las rutas estáticas con lo que ofrece la empresa - PÁGINA ESTÁTICA
Route::get('/', [ProductoController::class, 'index']);
Route::get('/tienda', [ProductoController::class, 'index'])->name('tienda');

Route::middleware(['auth'])->group(function () {
    Route::get('/tienda/carro/{id}', [ProductoController::class, 'addCarro']);
    Route::get('/tienda/verCarro', [ProductoController::class, 'verCarro']);
    Route::get('/tienda/quitar1Carro/{id}', [ProductoController::class, 'quitar1Carro']);
    Route::get('/tienda/quitarCarro/{id}', [ProductoController::class, 'quitarCarro']);
    Route::get('/tienda/hacerPedido', [PedidoController::class, 'hacerPedido']);

    //Estos para guardar productos nuevos
    Route::get('/tienda/create', [ProductoController::class, 'create']);
    Route::post('/tienda', [ProductoController::class, 'store'])->name('tienda.store');
});


Route::prefix('/dashboard')->group(function () {
    Route::middleware(['auth'])->group(function () {
        //Mis rutas ---------------------------------------

        //Ruta al entrar al panel de administración
        Route::get('/', [CitaController::class, 'index'])->name('dashboard');
        Route::get('/citas/delete/{cita}', [CitaController::class, 'destroy']);

        //Rutas asociadas al controlador resource CitaController
        //GET 	/citas 	index 	citas.index
        //GET 	/citas/create 	create 	citas.create
        //POST 	/citas 	store 	citas.store
        //GET 	/citas/{cita} 	show 	citas.show
        //GET 	/citas/{cita}/edit 	edit 	citas.edit
        //PUT/PATCH 	/citas/{cita} 	update 	citas.update
        //DELETE 	/citas/{cita} 	destroy 	citas.destroy
        Route::resource('citas', CitaController::class);

        //Ver horas libres en una fecha, para poder dar una cita
        Route::get('/citas/horasDisp/{fecha}', [CitaController::class, 'horasDisp']);

        //Rutas de PEDIDOS --------------------------------
        Route::get('/pedidos', [PedidoController::class, 'index'])->name('dashboard.pedidos');
        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        //Rutas para Servicios
        Route::get('/servicios', [ServicioController::class, 'index'])->name('dashboard.servicios');
        Route::get('/servicios/delete/{id}', [ServicioController::class, 'destroy']);
        Route::get('/servicios/create', [ServicioController::class, 'create']);
        Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
    });
});

require __DIR__ . '/auth.php';
