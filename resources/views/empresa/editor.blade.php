@extends('layouts.headerEmpresa')

@section('contenido')
@if (!$ofertaEditada)
        <div class="container mx-auto p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Crear Nueva Oferta</h2>
                <div>
                    <a href="javascript:history.back()" class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-200">Regresar</a>
                </div>
            </div>
            <form id="formOferta" action="/editor-oferta" method="POST" class="mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="tipo_oferta" class="block text-gray-700 font-semibold">Tipo de Oferta</label>
                        <select id="tipo_oferta" name="tipo_oferta" class="mt-2 block w-full p-3 border rounded-xl" required>
                            <option value="residencia">Residencia</option>
                            <option value="trabajo">Trabajo</option>
                        </select>
                        <span id="errorTipoOferta" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="nombre" class="block text-gray-700 font-semibold">Nombre de la Oferta</label>
                        <input type="text" id="nombre" name="nombre" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Nombre de la oferta" required>
                        <span id="errorNombre" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="ubicacion" class="block text-gray-700 font-semibold">Ubicación</label>
                        <input type="text" id="ubicacion" name="ubicacion" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Ubicación de la oferta" required>
                        <span id="errorUbicacion" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-semibold">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="mt-2 block w-full p-3 border rounded-xl" rows="4" placeholder="Descripción de la oferta" required></textarea>
                        <span id="errorDescripcion" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="vacantes_disponibles" class="block text-gray-700 font-semibold">Vacantes Disponibles</label>
                        <input type="number" id="vacantes_disponibles" name="vacantes_disponibles" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Número de vacantes" required>
                        <span id="errorVacantes" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="salario" class="block text-gray-700 font-semibold">Salario al mes en mxn</label>
                        <input type="number" id="salario" name="salario" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Salario ofrecido" required>
                        <span id="errorSalario" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="area_trabajo" class="block text-gray-700 font-semibold">Área de Trabajo</label>
                        <input type="text" id="area_trabajo" name="area_trabajo" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Área de trabajo correspondiente" required>
                        <span id="errorArea" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div>
                    <label for="carrera_solicitada" class="block text-gray-700 font-semibold">Carrera Solicitada</label>
                    <select id="options" name="carrera" class="px-4 py-2 rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-700">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->nombre }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200" onclick="return validarFormulario()">Crear Oferta</button>
                </div>
            </form>
        </div>


@else


        <div class="container mx-auto p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Editar oferta</h2>
                <a href="javascript:history.back()" class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-200">Regresar</a>
                @if ($ofertaEditada->area_residencia != null)<button onclick="eliminarResidencia()" class="ml-4 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200">Eliminar</button>
                @elseif ($ofertaEditada->area_trabajo != null)<button onclick="eliminarTrabajo()" class="ml-4 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200">Eliminar</button>
                @endif
            </div>
            @if ($ofertaEditada->area_residencia != null)
            <form id="formOferta" action="/editor-oferta/residencia{{$ofertaEditada->idoferta }}" method="POST" class="mt-6 space-y-6">
            @elseif ($ofertaEditada->area_trabajo != null)    
            <form id="formOferta" action="/editor-oferta/trabajo{{$ofertaEditada->idoferta }}" method="POST" class="mt-6 space-y-6">
            @endif
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="tipo_oferta" class="block text-gray-700 font-semibold">Tipo de Oferta</label>
                        <select id="tipo_oferta" name="tipo_oferta" class="mt-2 block w-full p-3 border rounded-xl" required>
                            @if ($ofertaEditada->area_residencia != null)
                            <option value="residencia">Residencia</option>
                            <option value="trabajo">Trabajo</option>
                            @elseif($ofertaEditada->area_trabajo != null) 
                            <option value="trabajo">Trabajo</option>
                            <option value="residencia">Residencia</option>
                            @endif
                        </select>
                        <span id="errorTipoOferta" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="nombre" class="block text-gray-700 font-semibold">Nombre de la Oferta</label>
                        <input value = "{{ $ofertaEditada->nombre }} " type="text" id="nombre" name="nombre" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Nombre de la oferta" required>
                        <span id="errorNombre" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="ubicacion" class="block text-gray-700 font-semibold">Ubicación</label>
                        <input value = "{{ $ofertaEditada->ubicacion }}" type="text" id="ubicacion" name="ubicacion" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Ubicación de la oferta" required>
                        <span id="errorUbicacion" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-semibold">Descripción</label>
                        <textarea  id="descripcion" name="descripcion" class="mt-2 block w-full p-3 border rounded-xl" rows="4" placeholder="Descripción de la oferta" required>{{ $ofertaEditada->descripcion }}</textarea>
                        <span id="errorDescripcion" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="vacantes_disponibles" class="block text-gray-700 font-semibold">Vacantes Disponibles</label>
                        <input value = "{{ $ofertaEditada->vacantes_disponibles }}" type="number" id="vacantes_disponibles" name="vacantes_disponibles" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Número de vacantes" required>
                        <span id="errorVacantes" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="salario" class="block text-gray-700 font-semibold">Salario al mes en mxn.</label>
                        <input value = "{{ $ofertaEditada->salario }}" type="number" id="salario" name="salario" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Salario ofrecido" required>
                        <span id="errorSalario" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>

                    <div>
                        <label for="area_trabajo" class="block text-gray-700 font-semibold">Área de Trabajo</label>
                        @if ($ofertaEditada->area_residencia != null) <input value = "{{ $ofertaEditada->area_residencia }}" type="text" id="area_trabajo" name="area_trabajo" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Área de trabajo correspondiente" required>
                        @elseif($ofertaEditada->area_trabajo != null) <input value = "{{ $ofertaEditada->area_trabajo }}" type="text" id="area_trabajo" name="area_trabajo" class="mt-2 block w-full p-3 border rounded-xl" placeholder="Área de trabajo correspondiente" required>
                        @endif
                        <span id="errorArea" class="text-red-500 text-sm hidden">Este campo es obligatorio.</span>
                    </div>
                </div>

                <div>
                    <label for="carrera_solicitada" class="block text-gray-700 font-semibold">Carrera Solicitada</label>
                    <select id="options" name="carrera" class="px-4 py-2 rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-700">
                        <option value="{{ $ofertaEditada->carrera_solicitada }}">{{ $ofertaEditada->carrera_solicitada }}</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->nombre }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200" onclick="return validarFormulario()">Guardar cambios</button>
                </div>
            </form>
        </div>
@endif


<script>
    function validarFormulario() {
        let esValido = true;
        const campos = ['tipo_oferta', 'nombre', 'ubicacion', 'descripcion', 'vacantes_disponibles', 'salario', 'area_trabajo', 'carrera_solicitada'];
        campos.forEach(campo => {
            const input = document.getElementById(campo);
            const error = document.getElementById(`error${campo.charAt(0).toUpperCase() + campo.slice(1)}`);
            
            if (!input.value.trim()) {
                esValido = false;
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        });
        const salario = document.getElementById('salario').value;
        if (isNaN(salario) || parseFloat(salario) <= 0) {
            alert('Por favor ingrese un salario válido (número positivo).');
            return false; 
        }
        return esValido;
    }
    function eliminarResidencia() {
        var idOferta = "{{ $ofertaEditada->idoferta ?? '' }}"; 
        if (!idOferta) {
            alert("No se puede eliminar, esta oferta aún no tiene un ID asignado.");
            return;  
        }

        if (confirm("¿Estás seguro de que deseas eliminar esta oferta?")) {
            window.location.href = "/eliminarResidencia/" + idOferta;
        }
}

    function eliminarTrabajo() {
        var idOferta = "{{ $ofertaEditada->idoferta ?? '' }}";  

        if (!idOferta) {
            alert("No se puede eliminar, esta oferta aún no tiene un ID asignado.");
            return;  
        }

        if (confirm("¿Estás seguro de que deseas eliminar esta oferta?")) {
            window.location.href = "/eliminarTrabajo/" + idOferta;
        }
    }
</script>
@endsection
