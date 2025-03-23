<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioAlumnoController;
use App\Http\Controllers\UsuarioEmpleadorController;
use App\Http\Controllers\EncuestasController;

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});



//mostrarAlumnos
Route::get('/mostrarAlumnos', [UsuarioAlumnoController::class, 'index']);
Route::get('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'mostrarInfo']);
Route::post('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'actualizarAlumno']);
//Empleadores
Route::get('/mostrarEmpleadores', [UsuarioEmpleadorController::class, 'index']);
Route::get('/infoEmpleador/{id}', [UsuarioEmpleadorController::class, 'mostrarInfo']);
Route::get('/infoResidencia/{id}', [UsuarioEmpleadorController::class, 'mostrarResidencia']);
Route::post('/infoResidencia/{id}', [UsuarioEmpleadorController::class, 'eliminarResidencia']);
Route::get('/infoTrabajo/{id}', [UsuarioEmpleadorController::class, 'mostrarTrabajo']);
Route::get('/crearEmpleador', [UsuarioEmpleadorController::class, 'formulario']);
Route::post('/crearEmpleador', [UsuarioEmpleadorController::class, 'nuevoEmpleador'])->name('usuariosEmpleador.nuevo');
//Encuestas
Route::get('/menuEncuestas', [EncuestasController::class, 'index']); //mostrar todas las encuestas
Route::post('/editorEncuesta', [EncuestasController::class, 'create']);//crear nueva encuesta
Route::get('/editorEncuesta', [EncuestasController::class, 'preguntas'])->name('encuestas.editor'); //abrir editor de encuesta sin reenviar datos
Route::get('/editorEncuesta/{id}', [EncuestasController::class, 'editar'])->name('encuestas.editor'); //editor para actualizar encuesta
Route::post('/editorEncuesta/{id}', [EncuestasController::class, 'actualizar']); //actualizar encuesta
//Vistas usuarioAlumno
Route::get('/dashboard/encuestas',[AlumnoController::class, 'mostrarEncuestas']);
Route::get('/dashboard/encuestas-respuesta{id}',[AlumnoController::class, 'responder']);
Route::post('/dashboard/encuestas-respuesta{id}',[AlumnoController::class, 'mandarRespuesta'])->name ('alumno.dashboard'); 
//Route::get('/mostrarEncuesta/{id}', [EncuestasController::class, 'show']);
/*
Route::get('/editorEncuesta', function () {
    return view('encuestas.editor');
})->name('encuestas.editor');
*/

//Test
Route::get('/update', [TestController::class, 'update']);