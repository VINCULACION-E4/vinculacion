@extends('layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h3 class="text-3xl font-bold mb-6 text-center text-blue-600">{{ $encuesta->titulo }}</h3>

        <div class="mb-6 text-center">
            <h4 class="text-xl font-medium text-gray-600">Descripción: {{ $encuesta->descripcion }}</h4>
        </div>

        <div class="space-y-4">
            @foreach ($preguntas as $asPregunta)
                <div class="p-4 border rounded-lg shadow-sm bg-white">
                    <p class="text-lg font-semibold text-gray-800">{{ $asPregunta->pregunta->texto }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection