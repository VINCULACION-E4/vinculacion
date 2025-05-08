@extends('layouts.headerAlumno')
@section('contenido')
    <div class="bg-green-50 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md text-center mx-4">
        <h2 class="text-2xl font-bold text-green-700 mb-4"> Cambio guardado correctamente </h2>
        <a href="/ofertas" 
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 mt-4 block text-center">
            Continuar
        </a>
        </div>
  </div>
@endsection