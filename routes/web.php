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

/*
Route::get('/dashboard/alumno', function () {
    return view('');
})->middleware('auth:alumno');

Route::get('/dashboard/empleador', function () {
    return view('dashboard.empleador');
})->middleware('auth:empleador');

Route::get('/dashboard/vinculacion', function () {
    return view('usuariosAlumnos.index');
})->middleware('auth:vinculacion');
*/

use App\Http\Controllers\VinculacionController;

use App\Http\Controllers\UsuarioAlumnoController;
use App\Http\Controllers\UsuarioEmpleadorController;
use App\Http\Controllers\EncuestasController;

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TestController;


Route::get('/', function () {
    return view('login');
});


Route::get('/vinculacion_ofertas', [VinculacionController::class, 'index'])->name('vinculacion.index');
Route::get('/vinculacion/cambiarEstadoResidencia/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoResidencia'])->name('vinculacion.cambiarEstadoResidencia');
Route::get('/vinculacion/cambiarEstadoTrabajo/{id}/{estado}', [VinculacionController::class, 'cambiarEstadoTrabajo'])->name('vinculacion.cambiarEstadoTrabajo');
//focus group
Route::get('/focus-group/mostrar', [VinculacionController::class, 'mostrarFocusGroup']);
Route::get('/focus-group/crear', [VinculacionController::class, 'crearFG']);
Route::post('/focus-group/crear', [VinculacionController::class, 'guardarFG'])->name('focus-group.guardar');
Route::get('/focus-group/editar{id}', [VinculacionController::class, 'editarFG']);
Route::get('/focus-group/eliminar/{id}', [VinculacionController::class, 'eliminarFG']);
Route::post('/focus-group/actualizarFG{id}', [VinculacionController::class, 'actualizarFG']);
Route::get('/focus-group/entrar{id}', [VinculacionController::class, 'entrarFG']);
Route::post('/focus-group/enviar-mensaje', [VinculacionController::class, 'enviarMensaje'])->name('focus-group.enviar-mensaje');


//mostrarAlumnos
Route::get('/mostrarAlumnos', [UsuarioAlumnoController::class, 'index']);
Route::post('/mostrarAlumnos', [UsuarioAlumnoController::class, 'index']);
Route::get('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'mostrarInfo']);
Route::post('/infoAlumno/{id}', [UsuarioAlumnoController::class, 'actualizarAlumno']);
Route::get('/alumnosCSV', [UsuarioAlumnoController::class, 'alumnosCSV']);
Route::get('/indicadores-clave', [UsuarioAlumnoController::class, 'mostrarIndicadoresClave']);
Route::post('/indicadores-clave', [UsuarioAlumnoController::class, 'mostrarIndicadoresClave'])->name('usuariosAlumnos.mostrarIndicadoresClave');
Route::post('/indicadores-clave/actualizar-atributos', [UsuarioAlumnoController::class, 'actualizarAtributos']);

//Empleadores desde vinculacion
Route::get('/mostrarEmpleadores', [UsuarioEmpleadorController::class, 'index']);
Route::get('/infoEmpleador/{id}', [UsuarioEmpleadorController::class, 'mostrarInfo']);
Route::post('/infoEmpleador/{id}', [UsuarioEmpleadorController::class, 'mostrarInfo'])->name('usuariosEmpleador.mostrarInfo');
Route::post('/infoEmpleador/actualizarEmpleador/{id}', [UsuarioEmpleadorController::class, 'actualizarEmpleador']);
Route::get('/infoEmpleador/eliminar/{id}', [UsuarioEmpleadorController::class, 'eliminarEmpleador']);
Route::get('/empleadoresCSV', [UsuarioEmpleadorController::class, 'empleadoresCSV']);
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
Route::get('/confirmarCambios/{id}', [EncuestasController::class, 'confirmar']);
Route::get('/eliminarEncuesta/{id}', [EncuestasController::class, 'delate']);
//Vistas usuarioAlumno
Route::get('/dashboard/encuestas',[AlumnoController::class, 'mostrarEncuestas']);
Route::post('/dashboard/encuestas',[AlumnoController::class, 'mostrarEncuestas']);
Route::get('/dashboard/encuestas-respuesta{id}',[AlumnoController::class, 'responder']);
Route::post('/dashboard/encuestas-respuesta{id}',[AlumnoController::class, 'mandarRespuesta'])->name ('alumno.dashboard'); 
Route::get('/ofertas',[AlumnoController::class, 'listarOfertas']);
Route::post('/ofertas',[AlumnoController::class, 'nuevaAsignacion'])->name('alumno.listarOfertas');
Route::post('/ofertas{id}',[AlumnoController::class, 'eliminarAsignacion'])->name('alumno.listarOfertas');
Route::get('/perfil',[AlumnoController::class, 'perfil']);
Route::post('/perfil',[AlumnoController::class, 'perfil']);
Route::post('/guardarPerfil',[AlumnoController::class, 'guardarPerfil'])->name('alumno.guardarPerfil');
Route::get('/alumno/focus-groups/mostrar',[AlumnoController::class, 'mostrarFocusGroups']);
Route::get('/alumno/focus-group/entrar{id}', [AlumnoController::class, 'entrarFG']);
Route::post('/alumno/focus-group/enviar-mensaje', [AlumnoController::class, 'enviarMensaje'])->name('focus-group.enviar-mensaje');


//vistas para empleadores
Route::get('/dashboardEmpresa', [EmpresaController::class, 'index']);
Route::get('/editor-oferta', [EmpresaController::class, 'abirEditor']);
Route::post('/editor-oferta', [EmpresaController::class, 'create'])->name('empresa.editor');
Route::get('/editor-oferta/residencia{id}', [EmpresaController::class, 'abirActualizarRes']);
Route::get('/editor-oferta/trabajo{id}', [EmpresaController::class, 'abirActualizarTra']);
Route::post('/editor-oferta/residencia{id}', [EmpresaController::class, 'actualizarDatosRes'])->name('empresa.editor');
Route::post('/editor-oferta/trabajo{id}', [EmpresaController::class, 'actualizarDatosTra'])->name('empresa.editor');
Route::get('/eliminarResidencia/{id}', [EmpresaController::class, 'delResidencia']);
Route::get('/eliminarTrabajo/{id}', [EmpresaController::class, 'delTrabajo']);
Route::get('/aspirantes-oferta/residencia{id}', [EmpresaController::class, 'aspirantesResidencia']);
Route::get('/aspirantes-oferta/trabajo{id}', [EmpresaController::class, 'aspirantesTrabajo']);
Route::get('/empleador/focus-group/mostrar',[EmpresaController::class, 'mostrarFocusGroups']);
Route::get('/empleador/focus-group/entrar{id}', [EmpresaController::class, 'entrarFG']);
Route::post('/empleador/focus-group/enviar-mensaje', [EmpresaController::class, 'enviarMensaje'])->name('focus-group.enviar-mensaje');


//Route::get('/mostrarEncuesta/{id}', [EncuestasController::class, 'show']);
/*
Route::get('/editorEncuesta', function () {
    return view('encuestas.editor');
})->name('encuestas.editor');
*/

//Test
//Route::get('/update', [TestController::class, 'update']);

