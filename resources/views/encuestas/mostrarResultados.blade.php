@extends('layouts.app');
@section('content')
<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-gray-800">Título: {{ $encuesta->titulo }}</h3>
    <h3 class="text-lg text-gray-700">Descripción: {{ $encuesta->descripcion }}</h3>
    <h3 class="text-md text-gray-600">ID: {{ $encuesta->idencuesta }}</h3>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full border border-gray-300 bg-white shadow-md">
            <thead>
                <tr class="bg-blue-500 text-white">
                    @foreach ($preguntas as $preg)
                        <th class="border px-4 py-2 text-center font-bold">{{ $preg->pregunta->texto }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($asRespuestas as $index => $asRespuesta)
                    @if ($index % count($preguntas) == 0)
                        <tr class="border-b">
                    @endif
                    <td class="border px-4 py-2 text-center">{{ $asRespuesta->respuesta->texto }}</td>
                    @if (($index + 1) % count($preguntas) == 0)
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection