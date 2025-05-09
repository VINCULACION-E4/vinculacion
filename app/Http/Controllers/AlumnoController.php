<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Encuesta;
use App\Models\PreguntasEncuesta;
use App\Models\Pregunta;
use App\Models\RespuestasPregunta;
use App\Models\Respuesta;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;
use App\Models\AsignacionResidencium;
use App\Models\AsignacionTrabajo; 
use Carbon\Carbon;

class AlumnoController extends Controller
{
    public function mostrarEncuestas(){
        $encuestas = Encuesta::all();
        return view('alumno.encuestas', compact('encuestas'));
    }

    public function responder($id){
        $encuesta = Encuesta::where('idencuesta', $id)->first();
        $preguntasAsignadas = preguntasEncuesta::where('encuestas_idencuesta', $id)->get();
        return view ('alumno.responderEncuesta', compact('encuesta','preguntasAsignadas'));
    }
    public function mandarRespuesta($id, Request $request){
        $respuestas = $request->input('respuestas'); 
        $ids = $request->input('ids'); 
        $idEncuestaRealizada = $request->input('idEncuesta');
        if($respuestas != null){
            foreach ($respuestas as $index => $respuesta) {
                $nuevaRespuesta = Respuesta::create([
                    'texto' => $respuesta, 
                ]);
                $nuevaAsignacion = new RespuestasPregunta();
                $nuevaAsignacion->respuestas_idrespuestas = $nuevaRespuesta->idrespuestas;
                $nuevaAsignacion->preguntas_idpreguntas = $ids[$index]; 
                $nuevaAsignacion->idencuesta = $idEncuestaRealizada;
                $nuevaAsignacion->save();
            }
        }
        $encuestas = Encuesta::all();
        return view('alumno.encuestas', compact('encuestas'));
    }

    public function listarOfertas() {
        $userAl = Auth::guard('usuarios_alumno')->user();
    
        if ($userAl->estatus_estudiante == 'Residente') {
            $ofertasTrabajo = null;
            $ofertasChambaAplicada = null;
            $ofertasAplicadasIds = AsignacionResidencium::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)
                ->pluck('ofertas_residencia_idoferta');
            $ofertasResidencia = OfertasResidencium::where('carrera_solicitada', $userAl->alumno->carrera->nombre)
                ->whereNotIn('idoferta', $ofertasAplicadasIds)
                ->get();
            $ofertasResAplicada = AsignacionResidencium::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)->get();
            return view('alumno.listarOfertas', compact('ofertasResidencia', 'ofertasTrabajo', 'ofertasResAplicada', 'ofertasChambaAplicada'));
        } else if ($userAl->estatus_estudiante == 'Egresado') {
            $ofertasResidencia = null;
            $ofertasResAplicada = null;
            $ofertasTrabajoAplicadasIds = AsignacionTrabajo::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)
                ->pluck('ofertas_trabajo_idoferta');
            $ofertasTrabajo = OfertasTrabajo::where('carrera_solicitada', $userAl->alumno->carrera->nombre)
                ->whereNotIn('idoferta', $ofertasTrabajoAplicadasIds)
                ->get();
            $ofertasChambaAplicada = AsignacionTrabajo::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)->get();
            return view('alumno.listarOfertas', compact('ofertasResidencia', 'ofertasTrabajo', 'ofertasResAplicada', 'ofertasChambaAplicada'));
        }
    
        return 'Error de carga';
    }
    
    

    public function nuevaAsignacion(Request $request){
        $idOferta = $request->input('oferta_id');
        $userAl = Auth::guard('usuarios_alumno')->user();
        $tipo = $request->input('tipo');
        if($tipo == 'residencia'){
            $comprobar = AsignacionResidencium::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)
                                      ->where('ofertas_residencia_idoferta', $idOferta)
                                      ->first();
            if(!$comprobar){
                $asignacion = AsignacionResidencium::create([
                    'ofertas_residencia_idoferta'=> $idOferta,
                    'usuarios_alumno_idusuarios_alumno'=> $userAl->idusuarios_alumno,
                    'fecha_asignacion'=>Carbon::now()->toDateString()
                ]);
                /*
                $oferta = OfertasResidencium::find($idOferta);
                $oferta->vacantes_disponibles =  $oferta->vacantes_disponibles-1;
                $oferta->save();
                */
            }else{
                return view ('alumno.error');
            }
            
        }elseif($tipo == 'trabajo'){
            $comprobar = AsignacionTrabajo::where('usuarios_alumno_idusuarios_alumno', $userAl->idusuarios_alumno)
                                      ->where('ofertas_trabajo_idoferta', $idOferta)
                                      ->first();
            if(!$comprobar){
                $asignacion = AsignacionTrabajo::create([
                    'ofertas_trabajo_idoferta'=> $idOferta,
                    'usuarios_alumno_idusuarios_alumno'=> $userAl->idusuarios_alumno,
                    'fecha_asignacion'=>Carbon::now()->toDateString()
                ]);
                /*
                $oferta = OfertasTrabajo::find($idOferta);
                $oferta->vacantes_disponibles =  $oferta->vacantes_disponibles-1;
                $oferta->save();
                */
            }
            else{
                return view ('alumno.error');
            } 
        }
        return view ('alumno.asignado');
    }

    public function eliminarAsignacion(Request $request,$id){
        $userAl = Auth::guard('usuarios_alumno')->user();
        $tipo = $request->input('tipo');
        if($tipo == 'residencia'){
            $asOferta = AsignacionResidencium::find($id);
            /*
            $oferta = OfertasResidencium::find($asOferta->ofertas_residencia_idoferta);
            $oferta->vacantes_disponibles =  $oferta->vacantes_disponibles+1;
            $oferta->save();
            */
            AsignacionResidencium::destroy($id);
        }else if($tipo == 'trabajo'){
            $asOferta = AsignacionTrabajo::find($id);
            /*
            $oferta = OfertasTrabajo::find($asOferta->ofertas_trabajo_idoferta);
            $oferta->vacantes_disponibles =  $oferta->vacantes_disponibles+1;
            $oferta->save();
            */
            AsignacionTrabajo::destroy($id);
        }
        return view('alumno.asignacionEliminada');
        
        if($userAl->estatus_estudiante == 'Residente'){
            $ofertasTrabajo = null;
            $ofertasChambaAplicada = null;
            $ofertasResidencia = OfertasResidencium::Where('carrera_solicitada',$userAl->alumno->carrera->nombre)->get();
            $ofertasResAplicada = AsignacionResidencium::Where('usuarios_alumno_idusuarios_alumno',$userAl->idusuarios_alumno)->get();
            return view ('alumno.listarOfertas', compact('ofertasResidencia', 'ofertasTrabajo', 'ofertasResAplicada','ofertasChambaAplicada'));
        }else if($userAl->estatus_estudiante == 'Egresado'){
            $ofertasResidencia=null;
            $ofertasResAplicada = null;
            $ofertasTrabajo = OfertasTrabajo::where('carrera_solicitada',$userAl->alumno->carrera->nombre)->get();
            $ofertasChambaAplicada = AsignacionTrabajo::Where('usuarios_alumno_idusuarios_alumno',$userAl->idusuarios_alumno)->get();   
            
            return view ('alumno.listarOfertas', compact('ofertasResidencia', 'ofertasTrabajo', 'ofertasResAplicada','ofertasChambaAplicada'));
        }
    }

    public function perfil(){
        $userAl = Auth::guard('usuarios_alumno')->user();
        return view ('alumno.perfil', compact('userAl'));
    }

    public function guardarPerfil(Request $request){
        $userAl = Auth::guard('usuarios_alumno')->user();
        $userAl->nombre_usuario = $request->input('nombre_usuario');
        $userAl->save();

        $alumno = $userAl->alumno;
        $alumno->correo_electronico = $request->input('correo_electronico');
        $alumno->numero_telefonico = $request->input('numero_telefonico');
        $alumno->save();
        return view ('alumno.perfil', compact('userAl'));
       
    }
}
