<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VinculacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vinculacion_ofertas', [VinculacionController::class, 'index'])->name('vinculacion.index');
Route::get('/vinculacion/cambiarEstadoResidencia/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoResidencia'])->name('vinculacion.cambiarEstadoResidencia');
Route::get('/vinculacion/cambiarEstadoTrabajo/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoTrabajo'])->name('vinculacion.cambiarEstadoTrabajo');