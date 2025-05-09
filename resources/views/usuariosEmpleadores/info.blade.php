@extends('layouts.app')
@section('content')
    <nav class="md:mr-20-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
        <a href="/mostrarAlumnos" >Alumnos</a>
        <div class="border-l-2 border-gray-500 h-6 mx-4"></div> 
        <a href="/mostrarEmpleadores" class="font-bold text-purple-700">Empleadores</a>
    </nav>
    <br>
    <!-- Seccion para ver info -->
    <form action="/infoEmpleador/actualizarEmpleador/{{ $empleador->rfc }}" method="POST" class="bg-white-100 container px-8 py-24 mx-auto flex flex-col border-2 border-blue-900">
        @csrf
    
        <div class="text-center text-3xl font-bold text-blue-900 mb-6">
            Información del empleador  
        </div>
        
        <div class="lg:w-4/6 mx-auto">
            <div class="flex flex-col sm:flex-row mt-10">
                <!-- Lado Izquierdo -->
                <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                    <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400 mx-auto">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col items-center text-center justify-center space-y-4 mt-4">
                        <div class="w-full">
                            <label for="nombre_comercial" class="text-xs text-gray-600">Nombre Comercial</label>
                            <input type="text" name="nombre_comercial" id="nombre_comercial" class="font-medium title-font mt-1 text-gray-900 text-2xl text-center border border-gray-300 rounded p-1 w-full" value="{{ $empleador->nombre_comercial }}">
                        </div>
                        <div class="w-full">
                            <label for="descripcion_de_la_empresa" class="text-xs text-gray-600">Descripción de la Empresa</label>
                            <textarea name="descripcion_de_la_empresa" id="descripcion_de_la_empresa" class="text-blue-900 border border-gray-300 mt-1 p-2 rounded w-full" rows="3">{{ $empleador->descripcion_de_la_empresa }}</textarea>
                        </div>
                        <div class="w-full">
                            <label for="correo_persona_responsable" class="text-xs text-gray-600">Correo Electrónico del Responsable</label>
                            <input type="email" name="correo_persona_responsable" id="correo_persona_responsable" class="text-base border border-gray-300 rounded p-1 w-full" value="{{ $empleador->correo_persona_responsable }}">
                        </div>
                        <div class="w-full">
                            <label for="telefono_persona_responsable" class="text-xs text-gray-600">Número Telefónico</label>
                            <input type="text" name="telefono_persona_responsable" id="telefono_persona_responsable" class="text-base border border-gray-300 rounded p-1 w-full" value="{{ $empleador->telefono_persona_responsable }}">
                        </div>
                        <div class="w-full">
                            <label for="sitio_web" class="text-xs text-gray-600">Sitio Web</label>
                            <input type="text" name="sitio_web" id="sitio_web" class="text-base border border-gray-300 rounded p-1 w-full" value="{{ $empleador->sitio_web }}">
                        </div>
                    </div>
                </div>
    
                <!-- Lado Derecho -->
                <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-blue-700 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                    <div class="space-y-4">
                        <div>
                            <label class="text-blue-500 font-bold">Razón social:</label>
                            <input type="text" name="razon_social" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->razon_social }}">
                        </div>
                        <div>
                            <label class="text-blue-500 font-bold">Tipo de empresa:</label>
                            <input type="text" name="tipo_de_empresa" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->tipo_de_empresa }}">
                        </div>
                        <div>
                            <label class="text-blue-500 font-bold">Sector:</label>
                            <input type="text" name="sector" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->sector }}">
                        </div>
                        <div>
                            <label class="text-blue-500 font-bold">Giro:</label>
                            <input type="text" name="giro" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->giro }}">
                        </div>
                        <div>
                            <label class="text-blue-500 font-bold">Número de empleados:</label>
                            <input type="number" name="numero_empleados" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->numero_empleados }}">
                        </div>
                        <div>
                            <label class="text-blue-500 font-bold">Dirección de la empresa:</label>
                            <textarea name="direccion_empresa" class="w-full border border-gray-300 rounded p-1" rows="2">{{ $empleador->direccion_empresa }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="colonia" class="text-sm text-gray-600 font-semibold">Colonia</label>
                                <input type="text" id="colonia" name="colonia" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->colonia }}">
                            </div>
                            <div>
                                <label for="codigo_postal" class="text-sm text-gray-600 font-semibold">Código Postal</label>
                                <input type="text" id="codigo_postal" name="codigo_postal" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->codigo_postal }}">
                            </div>
                            <div>
                                <label for="ciudad" class="text-sm text-gray-600 font-semibold">Ciudad</label>
                                <input type="text" id="ciudad" name="ciudad" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->ciudad }}">
                            </div>
                            <div>
                                <label for="estado" class="text-sm text-gray-600 font-semibold">Estado</label>
                                <input type="text" id="estado" name="estado" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->estado }}">
                            </div>
                            <div class="col-span-2">
                                <label for="pais" class="text-sm text-gray-600 font-semibold">País</label>
                                <input type="text" id="pais" name="pais" class="w-full border border-gray-300 rounded p-1" value="{{ $empleador->pais }}">
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Botón de enviar -->
        <div class="flex justify-center space-x-4 mt-10">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">
                Guardar cambios
            </button>
            
            <a href="/infoEmpleador/eliminar/{{ $empleador->rfc }}" 
               onclick="return confirm('¿Estás seguro de que deseas eliminar este empleador?')" 
               class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Eliminar Empleador
            </a>
        </div>
        
         
    </form>
    <br>
    <!-- Seccion para ver ofertas -->

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
                    <div class="bg-blue-50 border border-gray-200 p-6 rounded-lg mb-4"> <!-- Añadido mb-4 para espaciado entre tarjetas -->
                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                            <a class="flex title-font font-medium items-center text-gray-900 mb-2 md:mb-0">
                                <img src="{{ asset('images/trabajo.png') }}" alt="Logo de la empresa" class="w-15 h-10">
                            </a>
                        </div>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $Trabajo->nombre }}</h2>
                        <div class="bg-blue-400 text-white p-2 rounded font-bold inline-block">
                            {{ $Trabajo->vacantes_disponibles }} vacantes disponibles
                        </div>
                        <p class="leading-relaxed text-base">{{ $Trabajo->descripcion }}</p>
                        <a href="{{ url('/infoTrabajo/' . $Trabajo->idoferta) }}" class="text-indigo-500 inline-flex items-center">Mostrar más / rechazar
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
