@extends('layouts.app')
@section('content')
    <nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
        <a href="/mostrarAlumnos" >Alumnos</a>
        <div class="border-l-2 border-gray-500 h-6 mx-4"></div> 
        <a href="/mostrarEmpleadores" class="font-bold text-purple-700">Empleadores</a>
    </nav>
    <br>
    <div class="bg-white-100 container px-8 py-24 mx-auto flex flex-col border-2 border-blue-900">
        <div class="text-center text-3xl font-bold text-blue-900">
            Información del empleador  
        </div>
        
            <div class="lg:w-4/6 mx-auto">
                <div class="flex flex-col sm:flex-row mt-10">

                    <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                    <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col items-center text-center justify-center">
                        <h2 class="font-medium title-font mt-4 text-gray-900 text-2xl">{{ $empleador->nombre_comercial}}</h2>
                        <p class="text-center text-blue-900">
                            {{ $empleador->descripcion_de_la_empresa}}
                        </p>
                        <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                        <p class="text-base">
                            <span class="text-purple-500 font-bold">Correo electrónico del responsable:</span> <br>{{ $empleador->correo_persona_responsable}} <br>
                            <span class="text-purple-500 font-bold">Número telefónico:</span> {{ $empleador->telefono_persona_responsable }}<br>
                            <span class="text-purple-500 font-bold">Sitio web:</span> {{ $empleador->sitio_web }}
                    </div>
                    </div>

                    <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-blue-700 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                    <p class="leading-relaxed text-lg mb-4">
                        <span class="text-blue-500 font-bold">Razon social:</span>  {{ $empleador->razon_social}}  <br>
                            <div class="w-100 h-0.5 bg-indigo-300 rounded mt-2 mb-4"></div>
                        <span class="text-blue-500 font-bold">Tipo de empresa:</span> {{ $empleador->tipo_de_empresa}}  <br>
                            <div class="w-60 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                        <span class="text-blue-500 font-bold">Sector:</span>  {{ $empleador->sector}}<br>
                            <div class="w-75 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                        <span class="text-blue-500 font-bold">Giro:</span>  {{ $empleador->giro}}<br>
                            <div class="w-100 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                        <span class="text-blue-500 font-bold">Num. empeados:</span>  {{ $empleador->numero_empleados}}<br>
                            <div class="w-50 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                        <span class="text-blue-500 font-bold">Direccion empresa:</span>  {{ $empleador->direccion_empresa}}, {{ $empleador->colonia}} {{ $empleador->codigo_postal}}, {{ $empleador->ciudad}}, {{ $empleador->estado}} {{ $empleador->pais}}<br>
                            <div class="w-150 h-0.5 bg-indigo-300 rounded mt-2 mb-5"></div>
                    </p>
                    </div>

                </div>
            </div>
    </div>
    <br>
    <div class="bg-white-100 container px-8 py-24 mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 border-2 border-green-600">
        <div class="border-r border-gray-300 pr-4">
            @if ($ofResidencias->isNotEmpty())
                <p class="text-center text-xl font-bold text-blue-900 ">Residencias creadas por el empleador</p><br>
                @foreach ($ofResidencias as $Residencia)
                    <div class="bg-blue-50 border border-gray-200 p-6 rounded-lg mb-3">
                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                                <img src="{{ asset('images/egreso.png') }}" alt="Logo de la empresa" class="w-15 h-10">
                            </a>
                        </div>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $Residencia->nombre }}</h2>
                        <div class="bg-green-400 text-white p-2 rounded font-bold inline-block">
                            {{ $Residencia->vacantes_disponibles }} vacantes disponibles
                        </div>
                        <p class="leading-relaxed text-base">{{ $Residencia->descripcion }}</p>
                        <a href="{{ url('/infoResidencia/' . $Residencia->idoferta) }}" class="text-indigo-500 inline-flex items-center">Mostrar más / rechazar
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M5 12h14"></path>
                              <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                
                @endforeach
            @else
                <p class="text-center text-2xl font-bold text-blue-900">
                    No hay residencias creadas por el empleador
                </p>   
            @endif
        </div>
    
        <div class="pl-4">
            @if ($ofTrabajos->isNotEmpty())
                <p class="text-center text-xl font-bold text-blue-900">Trabajos creados por el empleador</p><br>
                @foreach ($ofTrabajos as $Trabajo)
                    <div class="bg-blue-50 border border-gray-200 p-6 rounded-lg">
                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                                <img src="{{ asset('images/trabajo.png') }}" alt="Logo de la empresa" class="w-15 h-10">
                            </a>
                        </div>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $Trabajo->nombre }}</h2>
                        <div class="bg-blue-400 text-white p-2 rounded font-bold inline-block">
                            {{ $Trabajo->vacantes_disponibles }} vacantes disponibles
                        </div>
                        <p class="leading-relaxed text-base">{{ $Trabajo->descripcion }}</p>
                        <a href="{{ url('/infoTrabajo/' . $Trabajo->idoferta) }}"class="text-indigo-500 inline-flex items-center">Mostrar más / rechazar
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M5 12h14"></path>
                              <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            @else
                <p class="text-center text-2xl font-bold text-blue-900">
                    No hay trabajos creados por el empleador
                </p>
            @endif
        </div>
    </div>
    
    <br>
    <br>

@endsection
