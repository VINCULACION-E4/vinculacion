@extends('layouts.app')

@section('content')
    
    <nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
        <a href="/mostrarAlumnos" class="font-bold text-purple-700">Alumnos</a>
        <div class="border-l-2 border-gray-500 h-6 mx-4"></div> <!-- Línea pequeña en el medio -->
        <a href="/mostrarEmpleadores">Empleadores</a>
    </nav>

    <br>
    
    <div class="bg-blue-200 p-4 rounded">
        <div class="bg-blue-300 rounded container mx-auto p-4">
            <form action="/mostrarAlumnos" method="GET">
                <div class="flex mx-4">
                    <input type="text" name="search" class="w-60 rounded bg-white text-black p-1" placeholder="Buscar..." value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <br>
    <h3 class="px-60 md:mr-auto text-xl font-bold mb-4 items-center">Lista de alumnos</h3>

    @foreach($usuariosAlumnos as $usuario)
    <div class="container px-4 py-1 mx-auto flex items-center md:flex-row flex-col bg-gray-100 border-3 rounded-xl border-gray-200 mb-3">
        <div class="flex flex-col md:pr-10 md:mb-0 mb-6 pr-0 w-full md:w-auto md:text-left text-center">
            <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">
                N.control: {{ $usuario->alumno_numero_control }}
            </h2>
            <div class="container mx-auto flex flex-col md:flex-row items-center rounded p-4">
                <h1 class="md:text-3xl text-2xl font-medium title-font text-gray-900 mb-4 md:mb-0 md:mr-2">
                    {{ $usuario->nombre_usuario }} {{ $usuario->alumno->apellido_paterno }} {{ $usuario->alumno->apellido_materno }}
                </h1>
                @if($usuario->estatus_estudiante === 'Egresado')
                <div class="bg-green-400 text-white p-2 rounded font-bold inline-block">
                    Egresado
                </div>
                @elseif($usuario->estatus_estudiante === 'Residente')
                <div class="bg-blue-400 text-white p-2 rounded font-bold inline-block">
                    Residente
                </div>
                @endif
               
            </div>
            
        </div>
        
        <div class="flex md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">
            <a href="{{ url('/infoAlumno/' . $usuario->alumno_numero_control) }}">
                <button class="bg-purple-500 text-white p-2 rounded hover:bg-purple-700 font-bold">
                    Mostrar
                </button>
            </a>
        </div>
    </div>
    @endforeach
@endsection
