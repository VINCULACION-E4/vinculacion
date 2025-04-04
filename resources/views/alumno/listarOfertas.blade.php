@extends('layouts.headerAlumno')
@section('contenido')
@php
$authUser = Auth::guard('usuarios_alumno')->user();
@endphp

@if ($ofertasResAplicada != null)
<h3 class="text-2xl text-center font-bold text-gray-800 mb-6">Actualmente te estás postulando en las siguientes ofertas:</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($ofertasResAplicada as $asOferta)
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out">
            <h3 class="text-xl font-bold text-blue-700">{{ $asOferta->ofertas_residencium->nombre }}</h3>
            <p class="mt-2 text-gray-700">{{ $asOferta->ofertas_residencium->descripcion }}</p>
            <div class="mt-3 text-sm text-gray-600">
                <p><strong>⭐ Empresa:</strong> {{$asOferta->ofertas_residencium->usuarios_empleador->empleadore->nombre_comercial }}</p>
                <p><strong>📍 Ubicación:</strong> {{ $asOferta->ofertas_residencium->ubicacion }}</p>
                <p><strong>💰 Salario:</strong> {{ $asOferta->ofertas_residencium->salario }}</p>
                <p><strong>🏢 Área:</strong> {{ $asOferta->ofertas_residencium->area_residencia }}</p>
            </div>
            <div class="mt-4">
                <form action="/ofertas{{$asOferta->idasignacion_residencia }}" method="POST">
                    @csrf
                    <input type="hidden" name="ofertaAs_id" value="{{ $asOferta->idasignacion_residencia}}">
                    <input type="hidden" name="tipo" value="residencia">
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200">
                        Dejar de aplicar
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>    
@elseif ($ofertasChambaAplicada != null)
<h3 class="text-2xl text-center font-bold text-gray-800 mb-6">Actualmente te estás postulando en las siguientes ofertas de trabajo:</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($ofertasChambaAplicada as $asOferta)
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out">
            <h3 class="text-xl font-bold text-blue-700">{{ $asOferta->ofertas_trabajo->nombre }}</h3>
            <h3 class="text-medium font-bold text-gray-700">Vacantes disponibles: {{ $asOferta->ofertas_trabajo->vacantes_disponibles }}</h3>
            <p class="mt-2 text-gray-700">{{ $asOferta->ofertas_trabajo->descripcion }}</p>
            <div class="mt-3 text-sm text-gray-600">
                <p><strong>⭐ Empresa:</strong> {{$asOferta->ofertas_trabajo->usuarios_empleador->empleadore->nombre_comercial }}</p>
                <p><strong>📍 Ubicación:</strong> {{ $asOferta->ofertas_trabajo->ubicacion }}</p>
                <p><strong>💰 Salario:</strong> {{ $asOferta->ofertas_trabajo->salario }}</p>
                <p><strong>🏢 Área:</strong> {{ $asOferta->ofertas_trabajo->area_trabajo }}</p>
            </div>
            <div class="mt-4">
                <form action="/ofertas{{$asOferta->idasignacion_residencia }}" method="POST">
                    @csrf
                    <input type="hidden" name="ofertaAs_id" value="{{ $asOferta->idasignacion_residencia }}">
                    <input type="hidden" name="tipo" value="trabajo">
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200">
                        Dejar de aplicar
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

@if($authUser->estatus_estudiante == 'Residente')
<h3 class="text-center text-2xl font-bold text-gray-800 mt-8 mb-6">Ofertas de Residencia disponibles</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($ofertasResidencia as $oferta)
        @if ($oferta->estado == 'Aceptada' && $oferta->vacantes_disponibles > 0)
        <div class="bg-white border-l-4 border-blue-500 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <h3 class="text-xl font-bold text-blue-600">{{ $oferta->nombre }}</h3>
            <h3 class="text-medium font-bold text-gray-700">Vacantes disponibles: {{ $oferta->vacantes_disponibles }}</h3>
            <p class="mt-2 text-gray-700">{{ $oferta->descripcion }}</p>
            <div class="mt-3 text-sm text-gray-600">
                <p><strong>⭐ Empresa:</strong> {{ $oferta->usuarios_empleador->empleadore->nombre_comercial }}</p>
                <p><strong>📍 Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                <p><strong>💰 Salario:</strong> {{ $oferta->salario }}</p>
                <p><strong>🏢 Área:</strong> {{ $oferta->area_residencia }}</p>
            </div>
            <div class="mt-4">
                <form action="/ofertas" method="POST">
                    @csrf
                    <input type="hidden" name="oferta_id" value="{{ $oferta->idoferta }}">
                    <input type="hidden" name="tipo" value="residencia">
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200">
                        Aplicar
                    </button>
                </form>
            </div>
        </div>
        @endif
    @endforeach
</div>
@elseif($authUser->estatus_estudiante == 'Egresado')
<h3 class="text-center  text-2xl font-bold text-gray-800 mt-8 mb-6">Ofertas de trabajo disponibles</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($ofertasTrabajo as $oferta)
        @if ($oferta->estado == 'Aceptada' && $oferta->vacantes_disponibles > 0)
            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                <h3 class="text-xl font-bold text-green-700">{{ $oferta->nombre }}</h3>
                <h3 class="text-medium font-bold text-gray-700">Vacantes disponibles: {{ $oferta->vacantes_disponibles }}</h3>
                <p class="mt-2 text-gray-700">{{ $oferta->descripcion }}</p>
                <div class="mt-3 text-sm text-gray-600">
                    <p><strong>⭐ Empresa:</strong> {{ $oferta->usuarios_empleador->empleadore->nombre_comercial }}</p>
                    <p><strong>📍 Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                    <p><strong>💰 Salario:</strong> {{ $oferta->salario }}</p>
                    <p><strong>🏢 Área:</strong> {{ $oferta->area_trabajo }}</p>
                </div>
                <div class="mt-4">
                    <form action="/ofertas" method="POST">
                        @csrf
                        <input type="hidden" name="oferta_id" value="{{ $oferta->idoferta }}">
                        <input type="hidden" name="tipo" value="trabajo">
                        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200">
                            Aplicar
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endif
@endsection
