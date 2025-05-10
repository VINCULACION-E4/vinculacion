@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">
  <div class="mb-6 text-center">
    <a href="/focus-group/crear" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-semibold text-sm uppercase rounded shadow hover:bg-blue-700 transition duration-150 ease-in-out">
      ➕ Crear Focus Group
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($focusGroups as $fg)
      <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-blue-500 transition hover:shadow-xl">
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">💬</span>
          <h2 class="text-2xl font-bold text-blue-700">{{ $fg->titulo }}</h2>
        </div>

        <p class="text-gray-600 text-sm mb-2">
          📅 <span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($fg->fecha)->format('d M Y') }}
        </p>

        <p class="text-gray-700 text-sm mb-3">
          📝 <span class="font-medium">Descripción:</span><br>
          <span class="block mt-1">{{ $fg->descripcion }}</span>
        </p>

        <p class="text-gray-600 text-sm mb-4">
          👤 <span class="font-medium">Creado por:</span> 
          {{ $fg->usuarios_vinculacion->nombre }} {{ $fg->usuarios_vinculacion->apellido_paterno }} {{ $fg->usuarios_vinculacion->apellido_materno }}
        </p>

        <div class="flex gap-2 mt-4">
          <a href="/focus-group/entrar{{ $fg->id_focus_group }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
            🚪 Entrar al Focus Group
          </a>
          <a href="/focus-group/editar{{ $fg->id_focus_group }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-yellow-600 transition">
            ✏️ Editar
          </a>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection
