@extends('layouts.headerAlumno')
@section('contenido')
    <div class="item-center">
        <h3 class = "font-bold text-center text-2xl"> Encuestas no respondidas: </h3>
    </div>
    <div class="container mx-auto flex flex-wrap">
        @foreach($encuestas as $encuesta)
            <div class="w-1/3 p-4">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-lg text-gray-700 font-semibold">{{ $encuesta->titulo }}</h2>
                    <p class="text-gray-500 mt-2">{{ $encuesta->descripcion }}</p>
                    <div class="mt-4">
                        <a href="/dashboard/encuestas-respuesta{{ $encuesta->idencuesta }}" class="text-blue-500">Ver encuesta</a>
                    </div>
                </div>
            </div>
        @endforeach     
    </div>
@endsection