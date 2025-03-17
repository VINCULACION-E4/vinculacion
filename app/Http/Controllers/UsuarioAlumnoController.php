<?php

namespace App\Http\Controllers;
use App\Models\AsignacionTrabajo;
use App\Models\OfertasTrabajo;

use App\Models\AsignacionResidencium;
use App\Models\OfertasResidencium;

use App\Models\UsuariosAlumno;
use App\Models\Alumno;
use Illuminate\Http\Request;


class UsuarioAlumnoController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    
    $usuariosAlumnos = UsuariosAlumno::where('alumno_numero_control', 'like', '%' . $search . '%')
                            ->orWhere('nombre_usuario', 'like', '%' . $search . '%')
                            ->orWhereHas('alumno', function($query) use ($search) {
                                $query->where('apellido_paterno', 'like', '%' . $search . '%')
                                      ->orWhere('apellido_materno', 'like', '%' . $search . '%');
                            })
                            ->get();
        return view('usuariosAlumnos.index', compact('usuariosAlumnos'));
    }

    public function mostrarInfo($id)
    {
        
        $alumno = Alumno::where('numero_control', $id)->first();
        $usuarioAlumno = UsuariosAlumno::where('alumno_numero_control', $id)->first();

        $asOfertaResidencia = AsignacionResidencium::where('usuarios_alumno_idusuarios_alumno', $usuarioAlumno->idusuarios_alumno)->first();
        $asOfertaTrabajo = AsignacionTrabajo::where('usuarios_alumno_idusuarios_alumno', $usuarioAlumno->idusuarios_alumno)->first();
        if ($asOfertaResidencia) {
            $oferta = OfertasResidencium::where('idoferta', $asOfertaResidencia->ofertas_residencia_idoferta)->first();
            $fecha = $asOfertaResidencia->fecha_asignacion;
        } elseif ($asOfertaTrabajo) {
            $oferta = OfertasTrabajo::where('idoferta', $asOfertaTrabajo->ofertas_trabajo_idoferta)->first();
            $fecha = $asOfertaTrabajo->fecha_asignacion;
        } else {
            $oferta = null;
            $fecha = null;
        }

        return view('usuariosAlumnos.info', compact('alumno', 'usuarioAlumno', 'oferta', 'fecha'));
            
    }
}
