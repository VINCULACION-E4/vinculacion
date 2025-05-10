<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;
use App\Models\AsignacionResidencium;
use App\Models\AsignacionTrabajo;
use App\Models\Carrera;

use App\Models\FocusGroup;
use App\Models\MensajeGrupo;
use App\Models\Mensaje;


class EmpresaController extends Controller
{
    public function index(){
        $user = Auth::guard('empleador')->user();
        $ofertasResidencia = OfertasResidencium::where('usuarios_empleador_idusuarios_empleador', $user->idusuarios_empleador)->get();
        $ofertasTrabajo = OfertasTrabajo::where('usuarios_empleador_idusuarios_empleador', $user->idusuarios_empleador)->get();
        return view('empresa.ofertas', compact('user', 'ofertasResidencia', 'ofertasTrabajo'));
    }

    public function abirEditor(){
        $carreras = Carrera::all();
        $ofertaEditada = null;
        return view('empresa.editor',compact('carreras', 'ofertaEditada'));
    }

    public function create(Request $request){
        
        $user = Auth::guard('empleador')->user();
        $tipo = $request->input('tipo_oferta');
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0.01',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'vacantes_disponibles' => 'required|integer|min:1',
            'area_trabajo' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
        ]);
        

        if($tipo == 'residencia'){
            $ofRes = OfertasResidencium::create([
               'nombre' => $data['nombre'],
               'descripcion' => $data['descripcion'],
               'ubicacion' => $data['ubicacion'],
               'vacantes_disponibles' => $data['vacantes_disponibles'],
               'salario' => $data['salario'],
               'area_residencia' => $data['area_trabajo'],
               'carrera_solicitada' => $data['carrera'],
               'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
               'estado' => 'Pendiente'
            ]);
        }else if($tipo == 'trabajo'){
            $ofRes = OfertasTrabajo::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'ubicacion' => $data['ubicacion'],
                'vacantes_disponibles' => $data['vacantes_disponibles'],
                'salario' => $data['salario'],
                'area_trabajo' => $data['area_trabajo'],
                'carrera_solicitada' => $data['carrera'],
                'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
                'estado' => 'Pendiente'
             ]);
        }
        return view ('empresa.completado');
    }
    public function abirActualizarRes($id){
        $ofertaEditada = OfertasResidencium::where('idoferta',$id)->first();
        $carreras = Carrera::all();
        return view('empresa.editor',compact('carreras','ofertaEditada'));
    }
    public function abirActualizarTra($id){
        $ofertaEditada = OfertasTrabajo::where('idoferta',$id)->first();
        $carreras = Carrera::all();
        return view('empresa.editor',compact('carreras','ofertaEditada'));
    }

    public function actualizarDatosRes(Request $request,$id){
        $user = Auth::guard('empleador')->user();
        $tipo = $request->input('tipo_oferta');
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0.01',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'vacantes_disponibles' => 'required|integer|min:1',
            'area_trabajo' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            ]);
        if ($tipo == 'residencia') {
            AsignacionResidencium::where('ofertas_residencia_idoferta', $id)->delete();
            $ofRes = OfertasResidencium::findOrFail($id); 
            $ofRes->update([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'ubicacion' => $data['ubicacion'],
                'vacantes_disponibles' => $data['vacantes_disponibles'],
                'salario' => $data['salario'],
                'area_residencia' => $data['area_trabajo'],
                'carrera_solicitada' => $data['carrera'],
                'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
                'estado' => 'Pendiente' 
            ]);
            } else if ($tipo == 'trabajo') {
                AsignacionResidencium::where('ofertas_residencia_idoferta', $id)->delete();
                OfertasResidencium::findOrFail($id)->delete();
                $ofTra= OfertasTrabajo::create([
                    'nombre' => $data['nombre'],
                    'descripcion' => $data['descripcion'],
                    'ubicacion' => $data['ubicacion'],
                    'vacantes_disponibles' => $data['vacantes_disponibles'],
                    'salario' => $data['salario'],
                    'area_trabajo' => $data['area_trabajo'],
                    'carrera_solicitada' => $data['carrera'],
                    'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
                    'estado' => 'Pendiente' 
                ]);
            }
        return view('empresa.completado');
    }

    public function actualizarDatosTra(Request $request,$id){
        $user = Auth::guard('empleador')->user();
        $tipo = $request->input('tipo_oferta');
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0.01',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'vacantes_disponibles' => 'required|integer|min:1',
            'area_trabajo' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            ]);
        if ($tipo == 'residencia') {
            AsignacionTrabajo::where('ofertas_trabajo_idoferta',$id)->delete();
            OfertasTrabajo::findOrFail($id)->delete();
            $ofRes = OfertasResidencium::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'ubicacion' => $data['ubicacion'],
                'vacantes_disponibles' => $data['vacantes_disponibles'],
                'salario' => $data['salario'],
                'area_residencia' => $data['area_trabajo'],
                'carrera_solicitada' => $data['carrera'],
                'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
                'estado' => 'Pendiente' 
            ]);
            } else if ($tipo == 'trabajo') {
                AsignacionTrabajo::where('ofertas_trabajo_idoferta',$id)->delete();
                $ofTra = OfertasTrabajo::findOrFail($id);
                $ofTra->update([
                    'nombre' => $data['nombre'],
                    'descripcion' => $data['descripcion'],
                    'ubicacion' => $data['ubicacion'],
                    'vacantes_disponibles' => $data['vacantes_disponibles'],
                    'salario' => $data['salario'],
                    'area_trabajo' => $data['area_trabajo'],
                    'carrera_solicitada' => $data['carrera'],
                    'usuarios_empleador_idusuarios_empleador' => $user->idusuarios_empleador,
                    'estado' => 'Pendiente' 
                ]);
            }
        return view('empresa.completado');
    }

    public function delResidencia($id){
        AsignacionResidencium::where('ofertas_residencia_idoferta', $id)->delete();
        OfertasResidencium::findOrFail($id)->delete();
        return view('empresa.completado');
    }

    public function delTrabajo($id){
        AsignacionTrabajo::where('ofertas_trabajo_idoferta',$id)->delete();
        OfertasTrabajo::findOrFail($id)->delete();
        return view('empresa.completado');
    }

    public function aspirantesResidencia($id){
        $asignaciones = AsignacionResidencium::where('ofertas_residencia_idoferta',$id)->get();
        $oferta = OfertasResidencium::where('idoferta',$id)->first();
        return view('empresa.aspirantesResidencia', compact('asignaciones','oferta'));
    }
    public function aspirantesTrabajo($id){
        $asignaciones = AsignacionTrabajo::where('ofertas_trabajo_idoferta',$id)->get();
        $oferta = OfertasTrabajo::where('idoferta',$id)->first();
        return view('empresa.aspirantesTrabajo', compact('asignaciones','oferta'));
    }

    public function mostrarFocusGroups(){
        $focusGroups = FocusGroup::all();
        return view('empresa.mostrarFG', compact('focusGroups'));
    }
    
    public function entrarFG($id)
    {
        $focusGroup = FocusGroup::find($id);
        $mensajesGrupo = MensajeGrupo::where('focus_group_id_focus_group', $id)->get();
        return view('empresa.detallesFG', compact('focusGroup', 'mensajesGrupo'));
    }

    public function enviarMensaje(Request $request)
    {
        $nuevoMensaje = new Mensaje();
        $nuevoMensaje->texto = $request->input('texto');
        $nuevoMensaje->nombre_usuario = $request->input('nombre_usuario');
        $nuevoMensaje->tipo_usuario = $request->input('tipo_usuario');
        $nuevoMensaje->save();

        $nuevoMensajeGrupo = new MensajeGrupo();
        $nuevoMensajeGrupo->mensaje_id_mensaje = $nuevoMensaje->id_mensaje;
        $nuevoMensajeGrupo->focus_group_id_focus_group = $request->input('focus_group_id_focus_group');
        $nuevoMensajeGrupo->save();
        
        $focusGroup = FocusGroup::find($request->input('focus_group_id_focus_group'));
        $mensajesGrupo = MensajeGrupo::where('focus_group_id_focus_group', $request->input('focus_group_id_focus_group'))->get();
        return view('empresa.detallesFG', compact('focusGroup', 'mensajesGrupo'));
    }
}
