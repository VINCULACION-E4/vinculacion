@extends('layouts.headerEmpresa')
@section('contenido')
<div class="container mx-auto px-4 mt-16">
  <h1 class="text-3xl font-bold text-center text-blue-800 mb-10">📋 Lista de Focus Groups</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($focusGroups as $fg)
      <div class="bg-white shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition duration-300 p-6 relative">
        
        <div class="flex items-center mb-4">
          <span class="text-4xl mr-3 text-blue-500">💬</span>
          <h2 class="text-2xl font-bold text-blue-700">{{ $fg->titulo }}</h2>
        </div>

        <div class="border-t border-gray-200 pt-4">
          <p class="text-gray-600 text-sm mb-2">
            📅 <span class="font-semibold">Fecha:</span> {{ \Carbon\Carbon::parse($fg->fecha)->format('d M Y') }}
          </p>

          <p class="text-gray-700 text-sm mb-3">
            📝 <span class="font-semibold">Descripción:</span><br>
            <span class="block mt-1 italic">{{ $fg->descripcion }}</span>
          </p>

          <p class="text-gray-600 text-sm mb-4">
            👤 <span class="font-semibold">Creado por:</span> 
            {{ $fg->usuarios_vinculacion->nombre }} {{ $fg->usuarios_vinculacion->apellido_paterno }} {{ $fg->usuarios_vinculacion->apellido_materno }}
          </p>
        </div>

        <div class="text-right mt-6">
          <a href="/empleador/focus-group/entrar{{ $fg->id_focus_group }}" 
             class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-blue-700 transition">
            🚪 Entrar
          </a>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection