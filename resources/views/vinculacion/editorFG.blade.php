@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 relative bg-white p-6 shadow-lg rounded-lg">
    <a href="javascript:history.back()" 
      class="inline-block mb-4 px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400 transition">
      ⬅️ Regresar
    </a>

  {{-- Botón Eliminar --}}
  @if (isset($focusGroup))
    <a href="{{ url('/focus-group/eliminar/' . $focusGroup->id_focus_group) }}"
      onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este Focus Group?')) { window.location.href = this.href; }"
      class="absolute top-4 right-4 text-red-600 hover:text-red-800 font-bold text-sm">
      🗑️ Eliminar
    </a>
  @endif

  <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
    {{ isset($focusGroup) ? 'Editar Focus Group' : 'Editor Focus Group' }}
  </h2>

  <form action="{{ isset($focusGroup) ? '/focus-group/actualizarFG' . $focusGroup->id_focus_group : '/focus-group/crear' }}" method="POST">
    @csrf

    {{-- Validaciones --}}
    @if ($errors->any())
      <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <strong>⚠️ Se encontraron errores:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="mb-4">
      <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
      <input type="text" id="titulo" name="titulo"
             value="{{ old('titulo', $focusGroup->titulo ?? '') }}"
             class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>

    <div class="mb-4">
      <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="4"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required>{{ old('descripcion', $focusGroup->descripcion ?? '') }}</textarea>
    </div>

    <input type="hidden" name="usuarios_vinculacion_idusuario_vinculacion" value="{{ $authUser->idusuario_vinculacion }}">

    <div class="flex justify-end">
      <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
        {{ isset($focusGroup) ? 'Actualizar' : 'Crear Focus Group' }}
      </button>
    </div>
  </form>
</div>

@endsection
