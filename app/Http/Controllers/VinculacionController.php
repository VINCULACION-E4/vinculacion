<?php

namespace App\Http\Controllers;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;
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
            return redirect()->route('vinculacion.index')->with('success', 'Estado de oferta de residencia actualizado.');
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
            return redirect()->route('vinculacion.index')->with('success', 'Estado de oferta de trabajo actualizado.');
        }
        return redirect()->route('vinculacion.index')->with('error', 'Oferta no encontrada.');
    }
    

}
