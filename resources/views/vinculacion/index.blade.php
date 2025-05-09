@extends('layouts.app2')

@section('title', 'Gestión de Ofertas')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container mx-auto px-4 py-6">
    
    <h1 class="text-2xl font-bold mb-4">Gestión de Ofertas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Pestañas para alternar entre Ofertas de Residencia y Ofertas de Trabajo -->
    <div class="flex border-b">
        <button id="tab-btn-residencia" class="py-2 px-4 text-gray-600 hover:text-gray-900 border-b-2 border-transparent focus:border-blue-500 transition"
            onclick="setActiveTab('residencia')">
            Ofertas de Residencia
        </button>
        <button id="tab-btn-trabajo" class="py-2 px-4 text-gray-600 hover:text-gray-900 border-b-2 border-transparent focus:border-blue-500 transition"
            onclick="setActiveTab('trabajo')">
            Ofertas de Trabajo
        </button>
    </div>

    <div class="tab-content mt-3">
        <!-- Ofertas de Residencia -->
<div id="residencia" class="tab-pane block">
    <h3 class="text-lg font-semibold mb-2">Ofertas de Residencia</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Descripción</th>
                <th class="border border-gray-300 px-4 py-2">Ubicación</th>
                <th class="border border-gray-300 px-4 py-2">Vacantes Disponibles</th>
                <th class="border border-gray-300 px-4 py-2">Salario</th>
                <th class="border border-gray-300 px-4 py-2">Área de trabajo</th>
                <th class="border border-gray-300 px-4 py-2">Carrera Solicitada</th>
                <th class="border border-gray-300 px-4 py-2">Estado</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ofertasResidencia as $oferta)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->idoferta }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->nombre }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->descripcion }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->ubicacion }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->vacantes_disponibles }}</td>
                <td class="border border-gray-300 px-4 py-2">${{number_format($oferta->salario, 2) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->area_recidencia }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->carrera_solicitada }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if($oferta->estado == 'Aceptada')
                        <span class="px-2 py-1 text-white bg-green-500 rounded-lg">Aceptada</span>
                    @elseif($oferta->estado == 'Rechazada')
                        <span class="px-2 py-1 text-white bg-red-500 rounded-lg">Rechazada</span>
                    @else
                        <span class="px-2 py-1 text-white bg-yellow-500 rounded-lg">Pendiente</span>
                    @endif
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <div class="relative">
                        <button onclick="toggleDropdown('residencia', {{ $oferta->idoferta }})"
                            class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md focus:outline-none">
                            Elegir opción
                        </button>
                        <div id="dropdown-residencia-{{ $oferta->idoferta }}" style="z-index:10;" class="hidden absolute bg-white border border-gray-300 mt-1 rounded-md w-32 shadow-lg">
                            <a href="{{ route('vinculacion.cambiarEstadoResidencia', ['id' => $oferta->idoferta, 'estado' => 'Pendiente']) }}?tab=residencia"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pendiente</a>
                            <a href="{{ route('vinculacion.cambiarEstadoResidencia', ['id' => $oferta->idoferta, 'estado' => 'Aceptada']) }}?tab=residencia"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Aceptada</a>
                            <a href="{{ route('vinculacion.cambiarEstadoResidencia', ['id' => $oferta->idoferta, 'estado' => 'Rechazada']) }}?tab=residencia"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Rechazada</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Ofertas de Trabajo -->
<div id="trabajo" class="tab-pane hidden">
    <h3 class="text-lg font-semibold mb-2">Ofertas de Trabajo</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Descripción</th>
                <th class="border border-gray-300 px-4 py-2">Estado</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ofertasTrabajo as $oferta)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->idoferta }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->nombre }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $oferta->descripcion }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if($oferta->estado == 'Aceptada')
                        <span class="px-2 py-1 text-white bg-green-500 rounded-lg">Aceptada</span>
                    @elseif($oferta->estado == 'Rechazada')
                        <span class="px-2 py-1 text-white bg-red-500 rounded-lg">Rechazada</span>
                    @else
                        <span class="px-2 py-1 text-white bg-yellow-500 rounded-lg">Pendiente</span>
                    @endif
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <div class="relative">
                        <button onclick="toggleDropdown('trabajo', {{ $oferta->idoferta }})"
                            class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md focus:outline-none">
                            Elegir opción
                        </button>
                        <div id="dropdown-trabajo-{{ $oferta->idoferta }}" style="z-index:10;" class="hidden absolute bg-white border border-gray-300 mt-1 rounded-md w-32 shadow-lg">
                            <a href="{{ route('vinculacion.cambiarEstadoTrabajo', ['id' => $oferta->idoferta, 'estado' => 'Pendiente']) }}?tab=trabajo"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pendiente</a>
                            <a href="{{ route('vinculacion.cambiarEstadoTrabajo', ['id' => $oferta->idoferta, 'estado' => 'Aceptada']) }}?tab=trabajo"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Aceptada</a>
                            <a href="{{ route('vinculacion.cambiarEstadoTrabajo', ['id' => $oferta->idoferta, 'estado' => 'Rechazada']) }}?tab=trabajo"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Rechazada</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
    
</div>



<script>
    function toggleDropdown(tab, id) {
        // Cerrar todos los dropdowns antes de abrir el nuevo
        document.querySelectorAll('.tab-content .absolute').forEach(el => {
            el.classList.add('hidden');
        });

        // Mostrar el dropdown específico
        const dropdown = document.getElementById('dropdown-' + tab + '-' + id);
        dropdown.classList.toggle('hidden');
    }

    function setActiveTab(tab) {
        document.getElementById('residencia').classList.add('hidden');
        document.getElementById('trabajo').classList.add('hidden');
        document.getElementById(tab).classList.remove('hidden');
    }

    // Cierra los dropdowns si haces clic fuera de ellos
    document.addEventListener('click', function(event) {
        const isDropdownButton = event.target.closest('button[onclick^="toggleDropdown"]');
        const isInsideDropdown = event.target.closest('.absolute');

        if (!isDropdownButton && !isInsideDropdown) {
            document.querySelectorAll('.tab-content .absolute').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'residencia';
        setActiveTab(activeTab);
    });

</script>

@endsection
