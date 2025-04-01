@extends('layouts.headerAlumno')
@section('contenido')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h3 class="text-xl font-bold text-blue-700 mb-4">
        Encuesta: {{$encuesta->titulo}}
    </h3>
    <p class="text-gray-600 mb-6">
        Descripción/Objetivos: {{$encuesta->descripcion}}
    </p>

    <form action="/dashboard/encuestas-respuesta{id}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="idEncuesta" value="{{$encuesta->idencuesta}}">
        @foreach ($preguntasAsignadas as $asignacion) 
            <div class="border-b pb-4">
                <label class="block text-lg font-medium text-gray-800">
                    {{$asignacion->pregunta->texto}}
                </label>
                <input type="hidden" name="ids[]" value="{{$asignacion->pregunta->idpreguntas}}">
                <input 
                    type="text" 
                    name="respuestas[]" 
                    class="mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Escribe tu respuesta aquí..."
                    required
                >
            </div>
        @endforeach

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700">
                Enviar Respuestas
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        
        form.addEventListener("submit", function (event) {
            let valid = true;
            const inputs = document.querySelectorAll('input[name="respuestas[]"]');
    
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    valid = false;
                    input.classList.add("border-red-500");
                } else {
                    input.classList.remove("border-red-500");
                }
            });
    
            if (!valid) {
                event.preventDefault();
                alert("Por favor, responde todas las preguntas antes de enviar.");
            }
        });
    });
    </script>
    
@endsection