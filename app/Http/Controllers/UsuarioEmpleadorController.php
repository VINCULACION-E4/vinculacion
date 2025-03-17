<?php

namespace App\Http\Controllers;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;


use Illuminate\Http\Request;
use App\Models\UsuariosEmpleador;
use App\Models\Empleadore;

use App\Models\AsignacionResidencium;
use App\Models\AsignacionTrabajo;

class UsuarioEmpleadorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $empleadores = UsuariosEmpleador::where('nombre_usuario', 'like', '%' . $search . '%')
                            ->orWhereHas('empleadore', function($query) use ($search) {
                                $query->where('nombre_comercial', 'like', '%' . $search . '%');
                            })
                        ->get();

        return view('usuariosEmpleadores.index', compact('empleadores'));
    }

    public function mostrarInfo($id)
    {
        $idEmpleador = UsuariosEmpleador::where('empleadores_rfc', $id)->first();
        $ofResidencias = OfertasResidencium::where('usuarios_empleador_idusuarios_empleador', $idEmpleador->idusuarios_empleador)->get();
        $ofTrabajos = OfertasTrabajo::where('usuarios_empleador_idusuarios_empleador', $idEmpleador->idusuarios_empleador)->get();


        $empleador = Empleadore::where('rfc', $id)->first();
        return view('usuariosEmpleadores.info', compact('empleador','ofResidencias','ofTrabajos'));
            
    }

    public function mostrarResidencia($id)
    {
        $oferta = OfertasResidencium::where('idoferta', $id)->first();
        $asignaciones = AsignacionResidencium::where('ofertas_residencia_idoferta', $id)->get();

        return view('usuariosEmpleadores.residencia', compact('oferta', 'asignaciones'));
    }
    public function mostrarTrabajo($id)
    {
        $oferta = OfertasTrabajo::where('idoferta', $id)->first();
        $asignaciones = AsignacionTrabajo::where('ofertas_trabajo_idoferta', $id)->get();

        return view('usuariosEmpleadores.trabajo', compact('oferta', 'asignaciones'));
    }
}
