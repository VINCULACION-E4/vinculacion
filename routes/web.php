<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioAlumnoController;
use App\Http\Controllers\UsuarioEmpleadorController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/mostrarAlumnos', [UsuarioAlumnoController::class, 'index']);
Route::get('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'mostrarInfo']);

Route::get('/mostrarEmpleadores', [UsuarioEmpleadorController::class, 'index']);
Route::get('/infoEmpleador/{id}', [UsuarioEmpleadorController::class, 'mostrarInfo']);
Route::get('/infoResidencia/{id}', [UsuarioEmpleadorController::class, 'mostrarResidencia']);
Route::get('/infoTrabajo/{id}', [UsuarioEmpleadorController::class, 'mostrarTrabajo']);