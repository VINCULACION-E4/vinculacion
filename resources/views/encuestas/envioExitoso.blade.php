@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">¡Correo Enviado Exitosamente!</h2>
            <p class="text-gray-600 mb-4">Tu mensaje ha sido enviado con éxito. Gracias por tu colaboración.</p>
            <a href="/menuEncuestas" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                Continuar
            </a>
        </div>
    </div>
@endsection
