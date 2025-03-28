<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Ruta para la página de registro
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

// Ruta para la página de inicio de sesión
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Vistas después del login
Route::get('/dashboard/alumno', function () {
    return view('');
})->middleware('auth:alumno');

Route::get('/dashboard/empleador', function () {
    return view('dashboard.empleador');
})->middleware('auth:empleador');

Route::get('/dashboard/vinculacion', function () {
    return view('usuariosAlumnos.index');
})->middleware('auth:vinculacion');

use App\Http\Controllers\VinculacionController;

use App\Http\Controllers\UsuarioAlumnoController;
use App\Http\Controllers\UsuarioEmpleadorController;
use App\Http\Controllers\EncuestasController;

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TestController;


Route::get('/', function () {
    return view('login');
});


Route::get('/vinculacion_ofertas', [VinculacionController::class, 'index'])->name('vinculacion.index');
Route::get('/vinculacion/cambiarEstadoResidencia/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoResidencia'])->name('vinculacion.cambiarEstadoResidencia');
Route::get('/vinculacion/cambiarEstadoTrabajo/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoTrabajo'])->name('vinculacion.cambiarEstadoTrabajo');



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
Route::post('/infoTrabajo/{id}', [UsuarioEmpleadorController::class, 'eliminarTrabajo']);
Route::get('/crearEmpleador', [UsuarioEmpleadorController::class, 'formulario']);
Route::post('/crearEmpleador', [UsuarioEmpleadorController::class, 'nuevoEmpleador'])->name('usuariosEmpleador.nuevo');
//Encuestas
Route::get('/menuEncuestas', [EncuestasController::class, 'index']); //mostrar todas las encuestas
Route::post('/editorEncuesta', [EncuestasController::class, 'create']);//crear nueva encuesta
Route::get('/editorEncuesta', [EncuestasController::class, 'preguntas'])->name('encuestas.editor'); //abrir editor de encuesta sin reenviar datos
Route::get('/editorEncuesta/{id}', [EncuestasController::class, 'editar'])->name('encuestas.editor'); //editor para actualizar encuesta
Route::post('/editorEncuesta/{id}', [EncuestasController::class, 'actualizar']); //actualizar encuesta
Route::get('/resultadosEncuesta/{id}', [EncuestasController::class, 'mostrarResultados']);
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

