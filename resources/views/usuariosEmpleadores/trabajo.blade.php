@extends('layouts.app')
@section('content')
<nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
    <a href="/mostrarAlumnos" >Alumnos</a>
    <div class="border-l-2 border-gray-500 h-6 mx-4"></div> 
    <a href="/mostrarEmpleadores" class="font-bold text-purple-700">Empleadores</a>
</nav>
<br>

<div class="bg-white py-6 sm:py-8 lg:py-12">
  <h3 class=" text-center px-60 md:mr-auto text-2xl font-bold mb-4 items-center">Detalles de la oferta</h3>
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="flex overflow-hidden rounded-lg bg-gray-100">
        <div class="relative hidden bg-gray-200 sm:block sm:w-1/3 lg:w-1/2">
          <img src="https://images.unsplash.com/photo-1604076913837-52ab5629fba9?auto=format&q=75&fit=crop&w=750" loading="lazy" alt="Photo by mymind" class="absolute inset-0 h-full w-full object-cover object-center" />
        </div>
        <div class="flex w-full items-center p-4 sm:w-2/3 sm:p-8 lg:w-1/2 lg:pl-10">
          <div class="flex w-full flex-col items-center sm:block">
            <div class="mb-4 sm:mb-8">
              <h2 class="text-center text-xl font-bold text-blue-500 sm:text-left sm:text-2xl lg:text-3xl">{{ $oferta->nombre}}</h2>
              <p class="text-center font-bold text-gray-500 sm:text-left"> De: {{ $oferta->usuarios_empleador->empleadore->razon_social}}</p>
              <p class="text-center text-gray-500 sm:text-left">{{ $oferta->descripcion}}</p><br>
              <div class="bg-blue-400 text-white p-2 rounded font-bold inline-block">
                {{ $oferta->vacantes_disponibles }} vacantes disponibles
              </div>
              <br>
              <br>
              <p class="text-center font-bold text-gray-500 sm:text-left"> Ubicación: {{ $oferta->ubicacion}}</p>
              <p class="text-center font-bold text-gray-500 sm:text-left"> Salario: ${{ $oferta->salario}} mxn</p>
              <p class="text-center font-bold text-gray-500 sm:text-left"> Área: {{ $oferta->area_trabajo}}</p><br>
              <p class="text-center text-gray-500 sm:text-left"> Para {{ $oferta->carrera_solicitada}}</p>
              <br>
              <div class="flex items-center justify-center">
                <form action = '/infoTrabajo/{{ $oferta->idoferta}}' method="POST">
                  @csrf
                    <input type="hidden" name="idEliminada" value="{{ $oferta->idoferta}}">
                    <button type="submit" class='bg-red-300 rounded w-35 h-10 hover:bg-red-400 font-bold text-white p-auto'>
                      Rechazar oferta
                    </button>
                <form>
              </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  
  <div class="text-center text-xl font-bold text-blue-500 sm:text-left sm:text-2xl lg:text-3xl">
    <h2>Alumnos egresados postulados:</h2>
  <div>
  <br>
  @if($asignaciones->isEmpty())
    <div class="text-center text-red-500 font-bold">
        No hay alumnos postulados para esta oferta.
    </div>
  @endif

  @foreach($asignaciones as $asignacion)
    <div class="container px-4 py-1 mx-auto flex items-center md:flex-row flex-col bg-gray-100 border-3 rounded-xl border-gray-200 mb-3">
        <div class="flex flex-col md:pr-10 md:mb-0 mb-6 pr-0 w-full md:w-auto md:text-left text-center">
            <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">
                N.control: {{ $asignacion->usuarios_alumno->alumno->numero_control }}
            </h2>
            <div class="container mx-auto flex flex-col md:flex-row items-center rounded p-4">
                <h1 class="md:text-3xl text-2xl font-medium title-font text-gray-900 mb-4 md:mb-0 md:mr-2">
                    {{ $asignacion->usuarios_alumno->alumno->nombre }} {{ $asignacion->usuarios_alumno->alumno->apellido_paterno }} {{ $asignacion->usuarios_alumno->alumno->apellido_materno }}
                </h1>
            </div>
        </div>

        <div class="flex md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">
            <a href="{{ url('/infoAlumno/' . $asignacion->usuarios_alumno->alumno->numero_control) }}">
                <button class="bg-purple-500 text-white p-2 rounded hover:bg-purple-700 font-bold">
                    Mostrar
                </button>
            </a>
        </div>
    </div>
    @endforeach
@endsection