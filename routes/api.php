<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rutas de autenticación al sistema

Route::prefix('/v1/auth')->group(function () {

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/registrar', [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/perfil', [AuthController::class, "funPerfil"]);
        Route::post('/salir', [AuthController::class, "funSalir"]);
    });
});


Route::apiResource("persona", PersonaController::class);


Route::apiResource("actividad", ActividadController::class);

Route::apiResource("ciudad", CiudadController::class);

Route::apiResource("precio", PrecioController::class);

Route::apiResource("estado", EstadoController::class);

Route::apiResource("orden", OrdenesController::class);

Route::apiResource("producto", ProductoController::class);

Route::apiResource("equipo", SeriesController::class);

Route::apiResource("abonado", ClienteController::class);

Route::get("/graficas", [GraficasController::class, "ordenes"]);
Route::get("/graficaCiudad", [GraficasController::class, "ciudad"]);