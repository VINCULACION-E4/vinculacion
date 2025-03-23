@extends('layouts.app');
@section('content')
<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-gray-800">Título: {{ $encuesta->titulo }}</h3>
    <h3 class="text-lg text-gray-700">Descripción: {{ $encuesta->descripcion }}</h3>
    <h3 class="text-md text-gray-600">ID: {{ $encuesta->idencuesta }}</h3>

    <div class="w-full overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full table-fixed"> <!-- Usamos table-fixed para columnas con el mismo tamaño -->
            <thead class="bg-blue-500 text-white">
                <tr>
                    @foreach ($preguntas as $preg)
                        <th class="px-4 py-2 text-center truncate">{{ $preg->pregunta->texto }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($asRespuestas as $index => $asRespuesta)
                    @if ($index % count($preguntas) == 0)
                        <tr class="align-top"> <!-- La clase align-top asegura que las celdas se alineen en la parte superior -->
                    @endif
                    <td class="px-4 py-2 text-center truncate">{{ $asRespuesta->respuesta->texto }}</td>
                    @if (($index + 1) % count($preguntas) == 0)
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableContainer = document.querySelector('.overflow-x-auto');
        let isDragging = false;
        let startX, scrollLeft;

        tableContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - tableContainer.offsetLeft;
            scrollLeft = tableContainer.scrollLeft;
        });

        tableContainer.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        tableContainer.addEventListener('mouseup', () => {
            isDragging = false;
        });

        tableContainer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - tableContainer.offsetLeft;
            const walk = (x - startX) * 2; // Ajusta la velocidad del desplazamiento
            tableContainer.scrollLeft = scrollLeft - walk;
        });
    });
</script>
@endsection