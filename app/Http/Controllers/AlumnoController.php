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
        return view ('alumno.dashboard');
    }

    public function listarOfertas(){
        $userAl = Auth::guard('usuarios_alumno')->user();
        $ofertasResidencia = OfertasResidencium::Where('carrera_solicitada',$userAl->alumno->carrera->nombre)->get();
        $ofertasTrabajo = OfertasTrabajo::where('carrera_solicitada',$userAl->alumno->carrera->nombre)->get();

        $ofertasResAplicada = AsignacionResidencium::Where('usuarios_alumno_idusuarios_alumno',$userAl->idusuarios_alumno)->get();
        $ofertasChambaAplicada = AsignacionTrabajo::Where('usuarios_alumno_idusuarios_alumno',$userAl->idusuarios_alumno)->get();
        return view ('alumno.listarOfertas', compact('ofertasResidencia', 'ofertasTrabajo', 'ofertasResAplicada','ofertasChambaAplicada'));
    }

    public function nuevaAsignacion(Request $request){
        $idOferta = $request->input('oferta_id');
        $userAl = Auth::guard('usuarios_alumno')->user();
        $tipo = $request->input('tipo');
        if($tipo == 'residencia'){
            $asignacion = AsignacionResidencium::create([
                'ofertas_residencia_idoferta'=> $idOferta,
                'usuarios_alumno_idusuarios_alumno'=> $userAl->idusuarios_alumno,
                'fecha_asignacion'=>Carbon::now()->toDateString()
            ]);
        }elseif($tipo == 'trabajo'){
            $asignacion = AsignacionTrabajo::create([
                'ofertas_residencia_idoferta'=> $idOferta,
                'usuarios_alumno_idusuarios_alumno'=> $userAl->idusuarios_alumno,
                'fecha_asignacion'=>Carbon::now()->toDateString()
            ]);
        }
        return view ('alumno.dashboard');
    }

    public function eliminarAsignacion(Request $request,$id){
        $tipo = $request->input('tipo');
        if($tipo == 'residencia'){
            AsignacionResidencium::destroy($id);
        }else if($tipo == 'trabajo'){
            AsignacionTrabajo::destroy($id);
        }
        
        return view ('alumno.dashboard');
    }
}
