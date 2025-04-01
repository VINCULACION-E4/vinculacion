<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\PreguntasEncuesta;
use App\Models\RespuestasPregunta;
use App\Models\Carrera;

class EncuestasController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        if ($search) {
           $encuestas = Encuesta::where('titulo', 'like', '%' . $search . '%')->get();
            
            return view('encuestas.index' , compact('encuestas'));
        }else{
            $encuestas = Encuesta::all();
            return view('encuestas.index' , compact('encuestas'));
        }
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $carreraSelect = $request->input('carrera');
            $data = $request->validate([
                'titulo' => 'required|string|max:255|unique:encuestas,titulo',
                'descripcion' => 'required|string|max:1000',
                'carrera' => 'required|string',
                'idEmpleado'=> 'required|integer'
            ]);
            $encuesta = Encuesta::create([
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'usuario_cordinacion_idusuario_cordinacion' =>  $data['idEmpleado'],
                'nombre_carrera' => $data['carrera']
            ]);
            $idEncuesta = $encuesta->idencuesta;
            
            
            $nuevasPreguntas = $request->input('preguntas');
            if($nuevasPreguntas != null){
            foreach ($nuevasPreguntas as $nuevapregunta) {
                $preguntaExistente = Pregunta::where('texto', $nuevapregunta)->first();
                if ($preguntaExistente) {
                    $nuevaAsignacion = new preguntasEncuesta();
                    $nuevaAsignacion->encuestas_idencuesta = $idEncuesta;
                    $nuevaAsignacion->preguntas_idpreguntas = $preguntaExistente->idpreguntas;
                    $nuevaAsignacion->save();

                } else {
                    $nueva = Pregunta::create([
                        'texto' => $nuevapregunta,  
                    ]);
                    $nuevaAsignacion = new preguntasEncuesta();
                    $nuevaAsignacion->encuestas_idencuesta = $idEncuesta;
                    $nuevaAsignacion->preguntas_idpreguntas = $nueva->idpreguntas;
                    $nuevaAsignacion->save();
                }
            }

            }
            return view ('layouts.homeVinculacion');
        }
    }

    public function actualizar(Request $request, $id){
        $nuevoTitulo = $request->input('titulo');
        $nuevaDescripcion = $request->input('descripcion');
        $nuevaCarrera = $request->input('carrera');
        $modificador = $request->input('idEmpleado');

        $encuesta = Encuesta::find($id);
        $encuesta->titulo = $nuevoTitulo;
        $encuesta->descripcion = $nuevaDescripcion;
        $encuesta->nombre_carrera = $nuevaCarrera;
        $encuesta->usuario_cordinacion_idusuario_cordinacion= $modificador;
        $encuesta->save();
        //borrar todas las preguntas asignadas
        preguntasEncuesta::where('encuestas_idencuesta', $id)->delete();
        //reasignar las preguntas
        $nuevasPreguntas = $request->input('preguntas');
        if($nuevasPreguntas != null){
        foreach ($nuevasPreguntas as $nuevapregunta) {
            $preguntaExistente = Pregunta::where('texto', $nuevapregunta)->first();
            if ($preguntaExistente) {
                $nuevaAsignacion = new preguntasEncuesta();
                $nuevaAsignacion->encuestas_idencuesta = $id;
                $nuevaAsignacion->preguntas_idpreguntas = $preguntaExistente->idpreguntas;
                $nuevaAsignacion->save();

            } else {
                $nueva = Pregunta::create([
                    'texto' => $nuevapregunta,  
                ]);
                $nuevaAsignacion = new preguntasEncuesta();
                $nuevaAsignacion->encuestas_idencuesta = $id;
                $nuevaAsignacion->preguntas_idpreguntas = $nueva->idpreguntas;
                $nuevaAsignacion->save();
            }
        }
        }
        $cambioExitoso = true;
        return view ('layouts.homeVinculacion');
    }

    public function editar($id){
        $carreras = Carrera::all();
        $bancoPreguntas = Pregunta::all();
        $encuesta = Encuesta::find($id);
        $preguntasAsignadas = preguntasEncuesta::where('encuestas_idencuesta', $id)->get();
        return view('encuestas.editor' , compact('encuesta', 'bancoPreguntas', 'preguntasAsignadas','carreras'));
    }

    public function preguntas(){
        $carreras = Carrera::all();
        $bancoPreguntas = Pregunta::all();
        $encuesta = null;
        return view('encuestas.editor' , compact('bancoPreguntas','encuesta', 'carreras'));
    }

    public function show($id){
        $encuesta = Encuesta::find($id);
        $preguntas = preguntasEncuesta::where('encuestas_idencuesta', $id)->get();
        return view('encuestas.show' , compact('encuesta', 'preguntas'));
    }

    public function mostrarResultados($id){
        $encuesta = Encuesta::find($id);
        $preguntas = preguntasEncuesta::where('encuestas_idencuesta', $id)->get();
        $asRespuestas = RespuestasPregunta::where('idencuesta', $id)->get();
        return view('encuestas.mostrarResultados' , compact('encuesta', 'preguntas', 'asRespuestas'));
    }
}
