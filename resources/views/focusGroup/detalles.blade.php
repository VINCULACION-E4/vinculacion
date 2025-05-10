@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">
    @php
    $usuario = Auth::guard('vinculacion')->user();
    @endphp
    <a href="javascript:history.back()" 
    class="inline-block mb-4 px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400 transition">
    ⬅️ Regresar
    </a>

  {{-- Card del Focus Group --}}
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6 border-t-4 border-blue-500 mb-8">
    <div class="flex items-center mb-4">
      <span class="text-3xl mr-2">💬</span>
      <h2 class="text-2xl font-bold text-blue-700">{{ $focusGroup->titulo }}</h2>
      
    </div>

    <p class="text-gray-600 text-sm mb-2">
      📅 <span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($focusGroup->fecha)->format('d M Y') }}
    </p>

    <p class="text-gray-700 text-sm mb-3">
      📝 <span class="font-medium">Descripción:</span><br>
      <span class="block mt-1">{{ $focusGroup->descripcion }}</span>
    </p>

    <p class="text-gray-600 text-sm">
      👤 <span class="font-medium">Creado por:</span> 
      {{ $focusGroup->usuarios_vinculacion->nombre }} {{ $focusGroup->usuarios_vinculacion->apellido_paterno }} {{ $focusGroup->usuarios_vinculacion->apellido_materno }}
    </p>
  </div>

  {{-- Lista de mensajes --}}
  <div class="max-w-4xl mx-auto bg-gray-50 p-6 rounded-lg shadow-inner mb-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">📨 Mensajes del Focus Group</h3>

    @forelse ($mensajesGrupo as $mensajeGrupo)
      <div class="mb-4 p-4 border-l-4 border-blue-300 bg-white rounded shadow-sm">
        <p class="text-gray-600 text-xs mb-1">
          📅 {{ \Carbon\Carbon::parse($mensajeGrupo->fecha)->format('d M Y H:i') }}
        </p>
        <p class="text-gray-800 mb-1">
          🧾 <span class="font-medium">Mensaje:</span> {{ $mensajeGrupo->mensaje->texto }}
        </p>
        <p class="text-sm text-gray-500">
          👤 <span class="font-medium">Usuario: {{  $mensajeGrupo->mensaje->nombre_usuario }} ({{ ucfirst($mensajeGrupo->mensaje->tipo_usuario) }})</span> 
        </p>
      </div>
    @empty
      <p class="text-gray-500">No hay mensajes aún en este Focus Group.</p>
    @endforelse
  </div>

  {{-- Formulario para enviar mensaje --}}
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold mb-4">✍️ Escribe un nuevo mensaje</h3>

    <form action="/focus-group/enviar-mensaje" method="POST">
      @csrf

      <input type="hidden" name="focus_group_id_focus_group" value="{{ $focusGroup->id_focus_group }}">

      <div class="mb-4">
        <label for="texto" class="block text-sm font-medium text-gray-700">Mensaje:</label>
        <textarea name="texto" id="texto" rows="4" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
      </div>

      <input type="hidden" name="tipo_usuario" value="Vinculacion">
      <input type="hidden" name="focus_group_id_focus_group" value="{{ $focusGroup->id_focus_group }}">
      <input type="hidden" name="nombre_usuario" value="{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}">

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Enviar Mensaje
      </button>
    </form>
  </div>
</div>

@endsection
