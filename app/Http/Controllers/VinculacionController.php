<?php

namespace App\Http\Controllers;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;

use App\Models\FocusGroup;
use App\Models\MensajeGrupo;
use App\Models\Mensaje;


use Illuminate\Http\Request;

class VinculacionController extends Controller
{
    // Mostrar todas las ofertas sin filtrar por estado
    public function index()
    {
    $ofertasResidencia = OfertasResidencium::all(); // Obtener ofertas de residencia
    $ofertasTrabajo = OfertasTrabajo::all(); // Asegúrate de tener este modelo

    return view('vinculacion.index', compact('ofertasResidencia', 'ofertasTrabajo'));
    }


    public function cambiarEstadoResidencia(Request $request, $id)
    {
        // Verifica si es una oferta de residencia 
        $ofertaResidencia = OfertasResidencium::find($id);
        // Si se encontró la oferta de residencia
        if ($ofertaResidencia) {
            $ofertaResidencia->estado = $request->estado;
            $ofertaResidencia->save();
            return redirect()->route('vinculacion.index', ['tab' => 'residencia'])->with('success', 'Oferta actualizada');
        }
        return redirect()->route('vinculacion.index')->with('error', 'Oferta no encontrada.');
    }

    public function cambiarEstadoTrabajo(Request $request, $id)
    {
        $ofertaTrabajo = OfertasTrabajo::find($id);
        
        // Si se encontró la oferta de trabajo
        if ($ofertaTrabajo) {
            $ofertaTrabajo->estado = $request->estado;
            $ofertaTrabajo->save();
            return redirect()->route('vinculacion.index', ['tab' => 'trabajo'])->with('success', 'Oferta actualizada');
        }
        return redirect()->route('vinculacion.index')->with('error', 'Oferta no encontrada.');
    }

    public function mostrarFocusGroup()
    {
        $focusGroups = FocusGroup::all();
        return view('vinculacion.menuFocusGroup', compact('focusGroups'));
    }

    public function crearFG()
    {
        return view('vinculacion.editorFG');
    }

    public function editarFG($id)
    {
        $focusGroup = FocusGroup::find($id);
        return view('vinculacion.editorFG', compact('focusGroup'));
    }

    public function actualizarFG(Request $request, $id)
    {
        $focusGroup = FocusGroup::find($id);
        $focusGroup->titulo = $request->input('titulo');
        $focusGroup->descripcion = $request->input('descripcion');
        $focusGroup->usuarios_vinculacion_idusuario_vinculacion = $request->input('usuarios_vinculacion_idusuario_vinculacion');
        $focusGroup->save();

        $focusGroups = FocusGroup::all();
        return view('vinculacion.menuFocusGroup', compact('focusGroups'));
    }

    public function guardarFG(Request $request)
    {
        $nuevoFG = new FocusGroup();
        $nuevoFG->titulo = $request->input('titulo');
        $nuevoFG->descripcion = $request->input('descripcion');
        $nuevoFG->usuarios_vinculacion_idusuario_vinculacion = $request->input('usuarios_vinculacion_idusuario_vinculacion');
        $nuevoFG->save();

        $focusGroups = FocusGroup::all();
        return view('vinculacion.menuFocusGroup', compact('focusGroups'));
    }

    public function eliminarFG($id)
    {
        $focusGroup = FocusGroup::find($id);
        if ($focusGroup) {
            MensajeGrupo::where('focus_group_id_focus_group', $focusGroup->id_focus_group)->delete();
            $focusGroup->delete();
        }
         $focusGroups = FocusGroup::all();
        return view('vinculacion.menuFocusGroup', compact('focusGroups'));
    }

    public function entrarFG($id)
    {
        $focusGroup = FocusGroup::find($id);
        $mensajesGrupo = MensajeGrupo::where('focus_group_id_focus_group', $id)->get();
        $authUser = auth()->user();
        return view('focusGroup.detalles', compact('focusGroup', 'mensajesGrupo'));
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
        $authUser = auth()->user();
        return view('focusGroup.detalles', compact('focusGroup', 'mensajesGrupo'));
    }
}
