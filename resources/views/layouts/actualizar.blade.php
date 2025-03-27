@extends('layouts.app')
@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-violet-600 p-8 rounded-lg shadow-lg w-96 item-center text-center justify-center  mx-auto">
    <h2 class="text-xl font-bold text-white">¡Cambios Registrados Exitosamente!</h2>
    <p class="mt-4 text-white">Los cambios en los datos del alumno han sido guardados correctamente.</p>
    <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Regresar</a>
</div>
@endsection