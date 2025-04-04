@extends('layouts.app')
@section('content')
<div class="flex justify-center pt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-96">
        <h2 class="text-xl font-bold text-red-600 mb-4">¿Estás seguro de que quieres eliminar esta encuesta?</h2>
        <p class="text-gray-700 mb-6">Las respuestas asociadas también serán eliminadas y no se podrán recuperar.</p>
        <div class="space-y-3">
            <a href="/eliminarEncuesta/{{$encuesta->idencuesta}}" class="block w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">Sí, eliminar</a>
            <a href="/menuEncuestas" class="block w-full bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600">Cancelar</a>
        </div>
    </div>
</div>
@endsection