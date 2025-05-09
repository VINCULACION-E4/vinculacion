@extends('layouts.app')
@section('content')
    <div class="bg-blue-200 p-4 rounded">
        <div class="bg-blue-300 rounded container mx-auto p-4">
            <form action="/menuEncuestas" method="GET">
                <div class="flex flex-col sm:flex-row gap-2 mx-4">
                    <input type="text" name="search" class="sm:w-60 w-full rounded bg-white text-black p-1" placeholder="Buscar..." value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <br>

    <div class="container px-4 py-1 mx-auto flex flex-col md:flex-row items-center bg-yellow-100 border-3 rounded-xl border-gray-200 mb-3">
        <div class="flex flex-col md:pr-10 mb-4 md:mb-0 text-center md:text-left w-full md:w-auto">
            <div class="flex flex-col md:flex-row items-center p-4">
                <h1 class="md:text-3xl text-2xl font-medium title-font text-gray-900 md:mb-0 mb-2 md:mr-2">
                    Crear una nueva encuesta
                </h1>
            </div>
        </div>
        <div class="flex justify-center md:ml-auto">
            <a href="/editorEncuesta">
                <button class="w-full md:w-auto bg-red-300 text-white p-2 rounded hover:bg-red-400 font-bold">
                    Crear 
                </button>
            </a>
        </div>   
    </div>

    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($encuestas as $encuesta)
                <div class="p-4">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg text-gray-700 font-semibold">{{ $encuesta->titulo }}</h2>
                        <p class="text-gray-500 mt-2">{{ $encuesta->descripcion }}</p>
                        <div class="mt-4 flex flex-col sm:flex-row justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                            <a href="/editorEncuesta/{{ $encuesta->idencuesta }}" class="text-blue-500">Ver/editar encuesta</a>
                            <a href="/resultadosEncuesta/{{ $encuesta->idencuesta }}" class="text-purple-600">Reporte de resultados</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
