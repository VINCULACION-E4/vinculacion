@extends('layouts.app')
@section('content')
    <nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
        <a href="/mostrarAlumnos" class="font-bold text-purple-700">Alumnos</a>
        <div class="border-l-2 border-gray-500 h-6 mx-4"></div> <!-- Línea pequeña en el medio -->
        <a href="/mostrarEmpleadores">Empleadores</a>
    </nav>

    <br>

    <div class="bg-white-100 container px-8 py-24 mx-auto flex flex-col border-2 border-blue-900">
        <div class="text-center text-3xl font-bold text-blue-900">
            Información del alumno
        </div>
        
            <div class="lg:w-4/6 mx-auto">
                <div class="flex flex-col sm:flex-row mt-10">
                    <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                    <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col items-center text-center justify-center">
                        <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $alumno->nombre}}  {{ $alumno->apellido_paterno}}  {{ $alumno->apellido_materno}}</h2>
                        <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                        <p class="text-base">
                            <span class="text-purple-500 font-bold">Correo electrónico:</span> {{ $alumno->correo_electronico }} <br>
                            
                            <span class="text-purple-500 font-bold">Número telefónico:</span> {{ $alumno->numero_telefonico }}
                        </p>
                    </div>
                    </div>

                    <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-blue-700 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                    <p class="leading-relaxed text-lg mb-4">
                        <span class="text-blue-500 font-bold">Carrera:</span> {{ $alumno->carrera->nombre}} <br>
                            <div class="w-120 h-0.5 bg-indigo-300 rounded mt-2 mb-4"></div>
                        <span class="text-blue-500 font-bold">Semestre en curso:</span> {{ $alumno->semestre_actual}} <br>
                            <div class="w-60 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                        <span class="text-blue-500 font-bold">Numero de control:</span> {{ $alumno->numero_control}} <br>
                            <div class="w-100 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                    </p>
                    </div>
                </div>
            </div>
            <br>
            <div class="mb-4">
                @if($usuarioAlumno->estatus_estudiante === 'Egresado')
                    <div class="p-4 bg-green-200 text-green-800 rounded">
                        <h3 class="font-bold">Este usuario actualmente es Empleado desde {{$fecha}}</h3>
                        <h3>Nombre de la oferta : {{ $oferta->nombre }}</h3>
                        <h3>Nombre de la empresa : {{ $oferta->usuarios_empleador->empleadore->razon_social}}</h3>
                        <h3>Sitio web:   {{ $oferta->usuarios_empleador->empleadore->sitio_web}}</h3>
                    </div>
                 <!-- Menu si es residente  --> 
                @elseif($usuarioAlumno->estatus_estudiante === 'Residente')
                    <div class="p-4 bg-blue-200 text-blue-800 rounded">
                        <h3 class="font-bold">Este usuario actualmente es Residente desde {{$fecha}}</h3>
                        <h3 class="font-bold">Estado de residencia : {{$usuarioAlumno->estatus_residencia }}</h3>
                        <h3>Nombre de la oferta : {{ $oferta->nombre }}</h3>
                        <h3>Nombre de la empresa : {{ $oferta->usuarios_empleador->empleadore->razon_social}}</h3>
                        <h3>Sitio web:   {{ $oferta->usuarios_empleador->empleadore->sitio_web}}</h3>
                    </div>
                @endif
            </div>
    </div>
    <br>
    <br>

@endsection
