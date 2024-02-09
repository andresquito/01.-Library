<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdministradorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('\vendor\adminlte\auth\login');
    //
    //sistema.addAdministrador
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/redirect',[AuthController::class,'redirect']);
Route::get('/auth/callback-url',[AuthController::class,'callback']);
Route::resource('/client', ClienteController::class)->names('cliente');
Route::resource('/user', AdministradorController::class)->names('administrador');
Route::resource('/obra', ObraController::class)->names('obra');
Route::resource('/venta', VentaController::class)->names('venta');
Route::resource('/factura', FacturaController::class)->names('factura');

//creada para facturacion.blade del boton realizar venta a la funcion factura.destroyALL
Route::delete('/eliminar-todos', [FacturaController::class, 'destroyAll'])->name('factura.destroyAll');





