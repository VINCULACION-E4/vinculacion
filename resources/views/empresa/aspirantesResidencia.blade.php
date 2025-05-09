@extends('layouts.headerEmpresa')

@section('contenido')
@php
    $authUser = Auth::guard('empleador')->user();
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Menú con datos de la oferta -->
    <!-- Botón de regreso -->
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200">
            ← Regresar
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl p-6 text-center mb-10">
        <h3 class="text-3xl font-bold text-blue-800 mb-4">Detalles de la oferta</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><strong>Nombre:</strong> {{ $oferta->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $oferta->descripcion }}</p>
            <p><strong>Vacantes disponibles:</strong> {{ $oferta->vacantes_disponibles }}</p>
            <p><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
            <p><strong>Salario:</strong> ${{ number_format($oferta->salario, 2) }}</p>
            <p><strong>Área:</strong> {{ $oferta->area_residencia }}</p>
            <p><strong>Carrera solicitada:</strong> {{ $oferta->carrera_solicitada }}</p>
        </div>
    </div>

    <!-- Título -->
    <h3 class="text-3xl font-bold text-center text-gray-800 mb-6">Aspirantes a Residencia</h3>

    <!-- Lista de tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($asignaciones as $asignacion)
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    {{ $asignacion->usuarios_alumno->alumno->nombre }}
                    {{ $asignacion->usuarios_alumno->alumno->apellido_paterno }}
                    {{ $asignacion->usuarios_alumno->alumno->apellido_materno }}
                </h2>
                <p class="text-gray-600"><strong>Correo:</strong> {{ $asignacion->usuarios_alumno->alumno->correo_electronico }}</p>
                <p class="text-gray-600"><strong>Teléfono:</strong> {{ $asignacion->usuarios_alumno->alumno->numero_telefonico }}</p>
                <p class="text-gray-600"><strong>Semestre:</strong> {{ $asignacion->usuarios_alumno->alumno->semestre_actual }}</p>
                <p class="text-gray-600"><strong>Carrera:</strong> {{ $asignacion->usuarios_alumno->alumno->carrera->nombre }}</p>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No hay aspirantes registrados para esta oferta.</p>
        @endforelse
    </div>
</div>
@endsection
