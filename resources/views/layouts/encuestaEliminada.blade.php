@extends('layouts.app');
@section('content')
    <section class="max-w-4xl mx-auto p-8 mt-8 bg-green-50 border-l-8 border-green-400 text-green-800 rounded-xl shadow-xl">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"></path>
            </svg>
            <p class="text-2xl font-semibold text-green-700">¡La encuesta fue eliminada con éxito!</p>
        </div>
       
        <div class="mt-6 flex justify-center">
            <a href="/menuEncuestas" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg transition duration-300 ease-in-out">
                Continuar
            </a>
        </div>
    </section>
@endsection