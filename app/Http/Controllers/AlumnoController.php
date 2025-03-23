<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\PreguntasEncuesta;
use App\Models\Pregunta;
use App\Models\RespuestasPregunta;
use App\Models\Respuesta;

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

        foreach ($respuestas as $index => $respuesta) {
            $nuevaRespuesta = Respuesta::create([
                'texto' => $respuesta, 
            ]);

            $nuevaAsignacion = new RespuestasPregunta();
            $nuevaAsignacion->respuestas_idrespuestas = $nuevaRespuesta->idrespuestas;
            $nuevaAsignacion->preguntas_idpreguntas = $ids[$index]; 
            $nuevaAsignacion->save();
        }
        return view ('alumno.dashboard');
    }
}
