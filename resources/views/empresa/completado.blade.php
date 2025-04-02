@extends('layouts.headerEmpresa')
@section('contenido')
<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-10 rounded-xl shadow-xl w-full sm:w-96">
        <div class="flex items-center justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 4.293a1 1 0 00-1.414 0L8 11.586 4.707 8.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
            </svg>
        </div>

        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-4">¡Proceso Realizado con Éxito!</h2>
        <p class="text-lg text-gray-600 text-center mb-6">Tu solicitud se ha completado con éxito. Gracias por tu paciencia.</p>

        <div class="flex justify-center">
            <a href="/dashboardEmpresa" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">Continuar</a>
        </div>
    </div>
</div>

@endsection