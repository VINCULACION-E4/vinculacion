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
    return view('dashboard.alumno');
})->middleware('auth:alumno');

Route::get('/dashboard/empleador', function () {
    return view('dashboard.empleador');
})->middleware('auth:empleador');

Route::get('/dashboard/vinculacion', function () {
    return view('dashboard.vinculacion');
})->middleware('auth:vinculacion');