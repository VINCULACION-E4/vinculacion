@extends('layouts.app')
@section('content')
    <nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
        <a href="/mostrarAlumnos" >Alumnos</a>
        <div class="border-l-2 border-gray-500 h-6 mx-4"></div> 
        <a href="/mostrarEmpleadores" class="font-bold text-purple-700">Empleadores</a>
    </nav>

    <br>
    
    <div class="bg-blue-200 p-4 rounded">
        <div class="bg-blue-300 rounded container mx-auto p-4">
            <form action="/mostrarEmpleadores" method="GET">
                <div class="flex mx-4">
                    <input type="text" name="search" class="w-60 rounded bg-white text-black p-1" placeholder="Buscar..." value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    
    <br>
    <h3 class="px-60 md:mr-auto text-xl font-bold mb-4 items-center">Lista de empleadores</h3>



    <div class="container mx-auto px-4">
        <!-- Grid con 3 columnas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($empleadores as $empleador)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <h5 class="text-xl font-semibold text-center text-gray-400">{{$empleador->empleadore->sector}}</h5>
                    <img src="{{ asset('images/empleadores/empresalogo.jpg') }}" alt="Logo de la empresa" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="text-xl font-semibold">{{$empleador->empleadore->nombre_comercial}}</h5>
                        <p class="text-gray-600 mt-2">Tipo de empresa: {{$empleador->empleadore->tipo_de_empresa}}</p>
                        <p class="text-gray-600 mt-2">Descripción: {{$empleador->empleadore->descripcion_de_la_empresa}}</p>
                        <br>
                        <a href="{{ url('/infoEmpleador/' . $empleador->empleadores_rfc) }}">
                            <button class="bg-blue-500 text-white p-2 rounded hover:bg-purple-700 font-bold">
                                Detalles
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection