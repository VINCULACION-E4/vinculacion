<?php

namespace App\Http\Controllers;
use App\Models\AsignacionTrabajo;
use App\Models\OfertasTrabajo;

use App\Models\AsignacionResidencium;
use App\Models\OfertasResidencium;

use App\Models\UsuariosAlumno;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;



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
             
    $userVin = Auth::guard('vinculacion')->user();
    //return $userVin->nombre_usuario;            
    return view('usuariosAlumnos.index', compact('usuariosAlumnos'));
    }

    public function mostrarInfo($id)
    {
        
        $alumno = Alumno::where('numero_control', $id)->first();
        $usuarioAlumno = UsuariosAlumno::where('alumno_numero_control', $id)->first();

        if ($usuarioAlumno->estatus_estudiante == 'Residente') {
            $asofertas = AsignacionResidencium::where('usuarios_alumno_idusuarios_alumno', $usuarioAlumno->idusuarios_alumno)->get();
            return view('usuariosAlumnos.info', compact('alumno', 'usuarioAlumno', 'asofertas'));
        } elseif ($usuarioAlumno->estatus_estudiante == 'Egresado') {
            $asofertas = AsignacionTrabajo::where('usuarios_alumno_idusuarios_alumno', $usuarioAlumno->idusuarios_alumno)->get();
            return view('usuariosAlumnos.info', compact('alumno', 'usuarioAlumno', 'asofertas'));
        } else {
            $ofertas = null;
            $fecha = null;
        }
        return view('usuariosAlumnos.info', compact('alumno', 'usuarioAlumno', 'ofertas', 'fecha'));    
    }

    public function actualizarAlumno(Request $request, $id) {
        $user = UsuariosAlumno::where('alumno_numero_control', $id)->first();
        $estado = $request->input('estado');
        $user->estatus_residencia = $estado;
        $user->save(); 
        return view('layouts.actualizar');
    }

    public function alumnosCSV()
    {
        $usuarios = UsuariosAlumno::all();
        
        // Cabeceras del CSV con UTF-8 BOM
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="alumnos.csv"',
        ];

        $callback = function() use ($usuarios) {
            // Agregar BOM para UTF-8
            echo "\xEF\xBB\xBF";
            
            $file = fopen('php://output', 'w');
            
            // Escribimos las cabeceras
            fputcsv($file, [
                'Número de Control',
                'Nombre',
                'Apellido Paterno',
                'Apellido Materno',
                'Semestre Actual',
                'Carrera',
                'Estatus Estudiante'
            ]);
            
            // Escribimos los datos
            foreach ($usuarios as $usuario) {
                fputcsv($file, [
                    $usuario->alumno->numero_control,
                    $usuario->alumno->nombre,
                    $usuario->alumno->apellido_paterno,
                    $usuario->alumno->apellido_materno,
                    $usuario->alumno->semestre_actual,
                    $usuario->alumno->carrera->nombre,
                    $usuario->estatus_estudiante
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
