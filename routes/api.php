<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('criterios', App\Http\Controllers\API\CriterioAPIController::class);





Route::resource('valoracions', App\Http\Controllers\API\ValoracionAPIController::class);

Route::resource('incidencias', App\Http\Controllers\API\IncidenciaAPIController::class);

Route::resource('clasificacions', App\Http\Controllers\API\ClasificacionAPIController::class);

Route::resource('habitacions', App\Http\Controllers\API\HabitacionAPIController::class);

Route::resource('clientes', App\Http\Controllers\API\ClienteAPIController::class);

Route::resource('registros', App\Http\Controllers\API\RegistroAPIController::class);

Route::resource('productos', App\Http\Controllers\API\ProductoAPIController::class);

Route::resource('servicios', App\Http\Controllers\API\ServicioAPIController::class);

Route::resource('servicio_detalles', App\Http\Controllers\API\ServicioDetalleAPIController::class);

Route::resource('medio_pagos', App\Http\Controllers\API\MedioPagoAPIController::class);

Route::resource('areas', App\Http\Controllers\API\AreaAPIController::class);

Route::resource('cargos', App\Http\Controllers\API\CargoAPIController::class);

Route::resource('empleados', App\Http\Controllers\API\EmpleadoAPIController::class);