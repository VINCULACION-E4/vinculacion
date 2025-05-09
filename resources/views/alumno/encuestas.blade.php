@extends('layouts.headerAlumno')
@section('contenido')
@php
$authUser = Auth::guard('usuarios_alumno')->user();
@endphp
    <div class="item-center">
        <h3 class="font-bold text-center text-2xl">Encuestas publicadas para ti:</h3>
    </div>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($encuestas as $encuesta)
                @if ($encuesta->nombre_carrera == $authUser->alumno->carrera->nombre || $encuesta->nombre_carrera == 'Todas')
                    <div class="p-4">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h2 class="text-lg text-gray-700 font-semibold">{{ $encuesta->titulo }}</h2>
                            <p class="text-gray-500 mt-2">{{ $encuesta->descripcion }}</p>
                            <div class="mt-4">
                                <a href="/dashboard/encuestas-respuesta{{ $encuesta->idencuesta }}" class="text-blue-500">Ver encuesta</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>    
@endsection
