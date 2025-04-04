@extends('layouts.headerAlumno')
@section('contenido')
    <div class="bg-green-50 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md text-center mx-4">
        <h2 class="text-2xl font-bold text-green-700 mb-4">🎉 ¡Felicidades!</h2>
        <p class="text-gray-700 text-lg mb-6">Estás aplicando a esta oferta.</p>
        <p class="text-gray-600 mb-6">El empleador se contactará contigo en caso de que seas seleccionado. ¡Buena suerte!</p>
        
        <!-- Botón Continuar -->
        <a href="/dashboard/encuestas" 
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 mt-4 block text-center">
            Continuar
        </a>
        </div>
  </div>
@endsection