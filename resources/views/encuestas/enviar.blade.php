@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Enviar correo electrónico</h2>
        
        <form method="POST" action="/encuesta/enviada">
            @csrf
            
            <div class="mb-4">
                <label for="para" class="block text-gray-700 font-medium mb-1">Para:</label>
                <input type="email" id="para" name="para" placeholder="correo@ejemplo.com"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mb-4">
                <label for="asunto" class="block text-gray-700 font-medium mb-1">Asunto:</label>
                <input type="text" id="asunto" name="asunto" value="Acceso a encuestas"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-6">
                <label for="mensaje" class="block text-gray-700 font-medium mb-1">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="7"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
Tienes una encuesta pendiente de responder.
Ingresa y coloca tus datos de inicio de sesión en:
https://vinculacion-proyecto-4bhwpd.laravel.cloud/ 

después, ingresa a la URL 
https://vinculacion-proyecto-4bhwpd.laravel.cloud/dashboard/encuestas-respuesta{{$id}}
                </textarea>
            </div>

            <button type="submit"
                class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Enviar correo
            </button>
        </form>
    </div>
</div>
@endsection
