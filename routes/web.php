<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioAlumnoController;
use App\Http\Controllers\UsuarioEmpleadorController;

use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/mostrarAlumnos', [UsuarioAlumnoController::class, 'index']);
Route::get('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'mostrarInfo']);
Route::post('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'actualizarAlumno']);


Route::get('/mostrarEmpleadores', [UsuarioEmpleadorController::class, 'index']);
Route::get('/infoEmpleador/{id}', [UsuarioEmpleadorController::class, 'mostrarInfo']);
Route::get('/infoResidencia/{id}', [UsuarioEmpleadorController::class, 'mostrarResidencia']);
Route::get('/infoTrabajo/{id}', [UsuarioEmpleadorController::class, 'mostrarTrabajo']);

Route::get('/update', [TestController::class, 'update']);