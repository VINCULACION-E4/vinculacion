@extends('layouts.headerEmpresa')
@section('contenido')
@php
    $authUser = Auth::guard('empleador')->user();
@endphp

<div class="container mx-auto p-6">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Abrir Editor de Ofertas</h2>
        <p class="text-gray-700 mt-2">Crea nuevas ofertas de residencia o trabajo utilizando el siguiente botón.</p>
        <a href="/editor-oferta" class="mt-4 inline-block px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition duration-200">Abrir Editor de Ofertas</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Columna de Residencias -->
        <div>
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Residencias</h2>
            <div class="space-y-6 h-[500px] overflow-y-auto p-4 border-4 rounded-2xl shadow-xl" style="border-image: linear-gradient(to bottom, #777, #999) 1;">
                @foreach ($ofertasResidencia as $ofRes)
                    @php
                        $estadoColor = '';
                        switch ($ofRes->estado) {
                            case 'Pendiente':
                                $estadoColor = 'bg-orange-500';
                                break;
                            case 'Aceptada':
                                $estadoColor = 'bg-green-500';
                                break;
                            case 'Rechazada':
                                $estadoColor = 'bg-red-500';
                                break;
                            default:
                                $estadoColor = 'bg-gray-500'; 
                        }
                    @endphp
                    <div class="bg-white shadow-xl rounded-2xl p-6 relative overflow-hidden transform hover:scale-101 transition duration-300 ease-in-out">
                        <div class="absolute top-0 right-0 {{ $estadoColor }} text-white px-4 py-2 rounded-bl-xl text-sm font-bold">{{ $ofRes->estado }}</div>
                        <h3 class="text-2xl font-semibold text-gray-900">{{ $ofRes->nombre }}</h3>
                        <p class="text-gray-700 mt-2 flex items-center"><span class="mr-2">📍</span><strong>Ubicación:</strong> {{ $ofRes->ubicacion }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">📝</span><strong>Descripción:</strong> {{ $ofRes->descripcion }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">👥</span><strong>Vacantes:</strong> {{ $ofRes->vacantes_disponibles }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">💰</span><strong>Salario:</strong> ${{ number_format($ofRes->salario, 2) }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">🏢</span><strong>Área:</strong> {{ $ofRes->area_residencia }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">🎓</span><strong>Carrera:</strong> {{ $ofRes->carrera_solicitada }}</p>

                        <div class="mt-4 flex space-x-4">
                            <a href="/editor-oferta/residencia{{ $ofRes->idoferta }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                                Editar
                            </a>
                            <a href="/aspirantes-oferta/residencia{{ $ofRes->idoferta }}" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200">
                                Mostrar Aspirantes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Columna de Trabajos -->
        <div>
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Trabajos</h2>
            <div class="space-y-6 h-[500px] overflow-y-auto p-4 border-4 rounded-2xl shadow-xl" style="border-image: linear-gradient(to bottom, #555, #666) 1;">
                @foreach ($ofertasTrabajo as $ofTra)
                    @php
                        $estadoColor = '';
                        switch ($ofTra->estado) {
                            case 'Pendiente':
                                $estadoColor = 'bg-orange-500';
                                break;
                            case 'Aceptada':
                                $estadoColor = 'bg-green-500';
                                break;
                            case 'Rechazada':
                                $estadoColor = 'bg-red-500';
                                break;
                            default:
                                $estadoColor = 'bg-gray-500'; 
                        }
                    @endphp
                    <div class="bg-white shadow-xl rounded-2xl p-6 relative overflow-hidden transform hover:scale-101 transition duration-300 ease-in-out">
                        <div class="absolute top-0 right-0 {{ $estadoColor }} text-white px-4 py-2 rounded-bl-xl text-sm font-bold">{{ $ofTra->estado }}</div>
                        <h3 class="text-2xl font-semibold text-gray-900">{{ $ofTra->nombre }}</h3>
                        <p class="text-gray-700 mt-2 flex items-center"><span class="mr-2">📍</span><strong>Ubicación:</strong> {{ $ofTra->ubicacion }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">📝</span><strong>Descripción:</strong> {{ $ofTra->descripcion }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">👥</span><strong>Vacantes:</strong> {{ $ofTra->vacantes_disponibles }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">💰</span><strong>Salario:</strong> ${{ number_format($ofTra->salario, 2) }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">🏢</span><strong>Área:</strong> {{ $ofTra->area_trabajo }}</p>
                        <p class="text-gray-700 flex items-center"><span class="mr-2">🎓</span><strong>Carrera:</strong> {{ $ofTra->carrera_solicitada }}</p>

                        <div class="mt-4 flex space-x-4">
                            <a href="/editor-oferta/trabajo{{ $ofTra->idoferta }}" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200">
                                Editar
                            </a>
                            <a href="/aspirantes-oferta/trabajo{{ $ofTra->idoferta }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                                Mostrar Aspirantes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
