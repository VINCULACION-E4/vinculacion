@extends('layouts.app')
@section('content')
<div class=" w-190  item-center text-center justify-center  mx-auto">
    @if ($encuesta==null)
        <form action="/editorEncuesta" method="POST" class="bg-white p-6 rounded-lg shadow-md w-160">
            @csrf
            <h2 class="text-xl font-bold mb-4 text-center">Crear encuesta</h2>
            <input type="hidden" name="idEmpleado" value="{{ $authUser->idusuario_vinculacion }}">
            <label for="nombre" class="block text-gray-700 font-medium">Nombre de la encuesta:</label>
            <input type="text" id="nombre" name="titulo" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
            
            <label for="descripcion" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"></textarea>
            <div class="flex items-center gap-4 bg-gray-100 p-3 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Carrera dirigida:</h3>
                <select id="options" name="carrera" class="px-4 py-2 rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-700">
                    <option value="Todas">Todas</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->nombre }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div>            
            <h3 class="text-xl font-bold mb-4 text-center">Selecciona una pregunta del banco de preguntas o crea una nueva pregunta</h3>
            <select id="options" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                onchange="cargarPregunta(this.value)">
                <option value="">Selecciona una pregunta</option>
                @foreach ($bancoPreguntas as $pregunta)
                <option value="{{ $pregunta->texto }}">{{ $pregunta->idpreguntas }} {{ $pregunta->texto }}</option>
                @endforeach
            </select>
            <br>
            <div id="preguntas-container" class="mb-4"></div>
            
            <button type="button" id="agregar-pregunta" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 mb-2">Agregar pregunta</button>
            <button type="button" id="quitar-pregunta" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 mb-4">Quitar última Pregunta</button>
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Guardar Encuesta</button>
        </form>
    @else
        <form action="/editorEncuesta/{{ $encuesta->idencuesta }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-160">
            @csrf
            <h2 class="text-xl font-bold mb-4 text-center">Editar encuesta</h2>
            <label for="nombre" class="block text-gray-700 font-medium">Encuesta creada por: {{ $encuesta->usuarios_vinculacion->nombre }} {{ $encuesta->usuarios_vinculacion->apellido_paterno }}</label>
            <input type="hidden" name="idEmpleado" value="{{ $authUser->idusuario_vinculacion }}">
            <label for="nombre" class="block text-gray-700 font-medium">Nombre de la encuesta:</label>
            <input type="text" id="nombre" name="titulo" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 " value="{{ $encuesta->titulo }}">
            <label for="descripcion" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 ">{{ $encuesta->descripcion }}</textarea>
            <div class="flex items-center gap-4 bg-gray-100 p-3 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Carrera dirigida:</h3>
                <select id="options" name="carrera" class="px-4 py-2 rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-700">
                    <option value="Todas">Todas</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->nombre }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div> 
            <h3 class="text-xl font-bold mb-4 text-center">Selecciona una pregunta del banco de preguntas o crea una nueva pregunta</h3>
            <select id="options" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                onchange="cargarPregunta(this.value)">
                <option value="">Selecciona una pregunta</option>
                @foreach ($bancoPreguntas as $pregunta)
                <option value="{{ $pregunta->texto }}">{{ $pregunta->idpreguntas }} {{ $pregunta->texto }}</option>
                @endforeach
            </select>
            
            <br>
            <div id="preguntas-container" class="mb-4">
                <!-- cargar preguntas ya asignadas-->
                @foreach ($preguntasAsignadas as $asPregunta)
                        <div class="mb-2">
                            <input
                                type="text"
                                name="preguntas[]"
                                id="pregunta-{{ $asPregunta->pregunta->id }}"
                                placeholder="Ingrese la respuesta"
                                value = "{{ $asPregunta->pregunta->texto }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('preguntas.' . $asPregunta->pregunta->id) }}"
                            >
                        </div>
             @endforeach

            </div>
            <button type="button" id="agregar-pregunta" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 mb-2">Agregar Pregunta</button>
            <button type="button" id="quitar-pregunta" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 mb-4">Quitar Última Pregunta</button>
            
            <button type="submit" class="w-full bg-yellow-200 text-black py-2 rounded-lg hover:bg-yellow-300">Guardar cambios</button>
        </form>
    @endif
    <script>

        function cargarPregunta(texto) {
            let container = document.getElementById('preguntas-container');
            let div = document.createElement('div');
            div.classList.add('mb-2');
            
            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'preguntas[]';
            input.placeholder = 'Ingrese la pregunta';
            input.value = texto;
            input.classList.add('w-full', 'px-3', 'py-2', 'border', 'rounded-lg', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500');
            
            div.appendChild(input);
            container.appendChild(div);
        }

        document.getElementById('agregar-pregunta').addEventListener('click', function() {
            let container = document.getElementById('preguntas-container');
            let div = document.createElement('div');
            div.classList.add('mb-2');
            
            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'preguntas[]';
            input.placeholder = 'Ingrese la pregunta';
            input.classList.add('w-full', 'px-3', 'py-2', 'border', 'rounded-lg', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500');
            
            div.appendChild(input);
            container.appendChild(div);
        });
        
        document.getElementById('quitar-pregunta').addEventListener('click', function() {
            let container = document.getElementById('preguntas-container');
            if (container.lastChild) {
                container.removeChild(container.lastChild);
            }
        });
    </script>
</div>
@endsection