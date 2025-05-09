@extends('layouts.headerAlumno')

@section('contenido')
<div class="container mx-auto mt-10 px-4 max-w-6xl">
    <!-- Encabezado con animación -->
    <div class="text-center mb-12 transform transition-all duration-500 hover:scale-105">
        <div class="flex justify-center">
            <div class="p-4 bg-blue-50 rounded-full shadow-inner">
                <svg class="w-20 h-20 text-blue-600 mb-2 transition duration-300 hover:text-blue-800" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0v.75H4.5v-.75z" />
                </svg>
            </div>
        </div>
        <h1 class="text-4xl font-bold text-blue-700 bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
            Mis Datos
        </h1>
        <p class="mt-2 text-gray-500">Administra tu información personal</p>
    </div>

    <!-- Formulario con mejor diseño -->
    <form action="/guardarPerfil" method="POST" class="flex flex-col lg:flex-row gap-8 w-full">
        @csrf

        <!-- Datos del Usuario -->
        <div class="bg-white rounded-xl p-8 w-full lg:w-1/2 border border-gray-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center mb-6">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Datos del Usuario</h2>
            </div>
            
            <div class="space-y-6">
                <div class="form-group">
                    <label for="nombre_usuario" class="block text-gray-700 font-medium mb-2">Nombre de usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" value="{{ $userAl->nombre_usuario }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                </div>
                
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <label class="block text-gray-700 font-medium mb-2">Estatus del estudiante</label>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                        <p class="text-gray-600 font-medium">{{ $userAl->estatus_estudiante }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Datos del Alumno -->
        <div class="bg-white rounded-xl p-8 w-full lg:w-1/2 border border-gray-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center mb-6">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Datos Académicos</h2>
            </div>
            
            <div class="space-y-6">
                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                    <p class="text-gray-800">
                        <span class="font-bold text-blue-700">Nombre completo:</span><br>
                        {{ $userAl->alumno->nombre }} {{ $userAl->alumno->apellido_paterno }} {{ $userAl->alumno->apellido_materno }}
                    </p>
                </div>

                <div class="form-group">
                    <label for="correo_electronico" class="block text-gray-700 font-medium mb-2">Correo electrónico</label>
                    <input type="email" id="correo_electronico" name="correo_electronico" value="{{ $userAl->alumno->correo_electronico }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                </div>

                <div class="form-group">
                    <label for="numero_telefonico" class="block text-gray-700 font-medium mb-2">Número telefónico</label>
                    <input type="text" id="numero_telefonico" name="numero_telefonico" value="{{ $userAl->alumno->numero_telefonico }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <p class="text-gray-800">
                        <span class="font-bold text-blue-700">Semestre actual:</span><br>
                        {{ $userAl->alumno->semestre_actual }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Botón de guardar con mejor diseño -->
        <div class="w-full flex justify-center mt-8 px-4">
            <button type="submit" class="relative bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 hover:from-blue-700 hover:to-blue-600 h-[42px] min-w-[180px] flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Guardar cambios
            </button>
        </div>
    </form>
</div>

<style>
    .form-group input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .bg-gradient-text {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }
</style>
@endsection