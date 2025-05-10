@extends('layouts.app')

@section('content')
<div class="p-6 bg-gradient-to-b from-indigo-50 to-white min-h-screen">
    <h2 class="text-3xl font-bold text-indigo-800 mb-8 text-center">Indicadores Clave</h2>
    @if (session('success'))
        <div class="mb-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Éxito! </strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- GRAFICA -->
    <div class="mb-16">
        <h3 class="text-2xl font-semibold text-center text-indigo-800 mb-6">Alumnos inscritos por carrera</h3>
        <div class="max-w-4xl mx-auto">
            <canvas id="graficaAlumnos" class="w-full h-96"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($carreras as $carrera)
            <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden transition duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-indigo-200 to-indigo-100 p-5">
                    <h3 class="text-xl font-semibold text-indigo-900">{{ $carrera->nombre }}</h3>
                </div>

                <div class="p-5 space-y-2 text-gray-700 text-sm">
                    @php
                        $atributoCarrera = $atributos->firstWhere('carrera_idcarrera', $carrera->idcarrera);
                        $alumnosInscritos = $alumnos->where('carrera_idcarrera', $carrera->idcarrera)->count();
                    @endphp
                    <p><span class="font-semibold text-indigo-700">Clave:</span> {{ $carrera->clave }}</p>
                    <p><span class="font-semibold text-indigo-700">Duración:</span> {{ $carrera->duracion_semestres }} semestres</p>
                    <p><span class="font-semibold text-indigo-700">Modalidad:</span> {{ $carrera->modalidad }}</p>
                    <p><span class="font-semibold text-indigo-700">Alumnos inscritos:</span> {{ $alumnosInscritos }}</p>

                    <div class="mt-4 bg-indigo-50 rounded-lg p-3">
                        <h4 class="text-indigo-700 font-semibold mb-2">Atributos</h4>
                        
                        @if ($atributoCarrera)
                            <form action="/indicadores-clave/actualizar-atributos" method="POST" class="space-y-3" onsubmit="return confirmarGuardado();">
                                @csrf
                                <input type="hidden" name="idatributo" value="{{ $atributoCarrera->idatributosegreso }}">
                                <div>
                                    <label class="block font-medium text-sm">Competencias</label>
                                    <textarea name="competencias" rows="2" class="w-full border rounded-lg p-2 text-sm">{{ $atributoCarrera->competencias }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm">Habilidades</label>
                                    <textarea name="habilidades" rows="2" class="w-full border rounded-lg p-2 text-sm">{{ $atributoCarrera->habilidades }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm">Tecnologías dominadas</label>
                                    <textarea name="tecnologias_dominadas" rows="2" class="w-full border rounded-lg p-2 text-sm">{{ $atributoCarrera->tecnologias_dominadas }}</textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                        Guardar cambios
                                    </button>
                                </div>
                            </form>
                        @else
                            <span class="inline-block px-3 py-1 text-sm bg-red-100 text-red-800 rounded-full">
                                Sin atributos registrados
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('graficaAlumnos').getContext('2d');

        const data = {
            labels: {!! json_encode($carreras->pluck('nombre')) !!},
            datasets: [{
                label: 'Alumnos inscritos',
                data: [
                    @foreach($carreras as $carrera)
                        {{ $alumnos->where('carrera_idcarrera', $carrera->idcarrera)->count() }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.6)',
                    'rgba(96, 165, 250, 0.6)',
                    'rgba(129, 140, 248, 0.6)',
                    'rgba(165, 180, 252, 0.6)',
                    'rgba(199, 210, 254, 0.6)',
                    'rgba(224, 231, 255, 0.6)'
                ],
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>
</div>
@endsection
