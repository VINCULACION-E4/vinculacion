<?php

namespace App\Http\Controllers;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;


use Illuminate\Http\Request;
use App\Models\UsuariosEmpleador;
use App\Models\Empleadore;

use App\Models\AsignacionResidencium;
use App\Models\AsignacionTrabajo;
use Illuminate\Support\Facades\Hash;


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

    public function formulario(){
        return view('usuariosEmpleadores.nuevo');
    }

    public function nuevoEmpleador(Request $request){
        if ($request->isMethod('post')) {
            $rfc = $request->input('rfc');
            $nombre_comercial = $request->input('nombre_comercial');
            $razon_social = $request->input('razon_social');
            $tipo_empresa = $request->input('tipo_empresa');
            $sector = $request->input('sector');
            $giro = $request->input('giro');
            $num_empleados = $request->input('num_empleados');
            $direccion = $request->input('direccion');
            $colonia = $request->input('colonia');
            $ciudad = $request->input('ciudad');
            $estado = $request->input('estado');
            $codigo_postal = $request->input('codigo_postal');
            $pais = $request->input('pais');
            $descripcion = $request->input('descripcion');
            $sitio_web = $request->input('sitio_web');
            $responsable_nombre = $request->input('responsable_nombre');
            $responsable_puesto = $request->input('responsable_puesto');
            $responsable_telefono = $request->input('responsable_telefono');
            $responsable_correo = $request->input('responsable_correo');
            $carrera_interes = $request->input('carrera_interes');
            $usuario = $request->input('usuario');
            $password = $request->input('password');
            
            $empleador = Empleadore::create([
                'rfc' => $rfc,
                'logo_url' => null,
                'nombre_comercial' => $nombre_comercial,
                'razon_social' => $razon_social,
                'tipo_de_empresa' => $tipo_empresa,
                'sector' => $sector,
                'giro' => $giro,
                'numero_empleados' => $num_empleados,
                'direccion_empresa' => $direccion,
                'colonia' => $colonia,
                'ciudad' => $ciudad,
                'estado' => $estado,
                'codigo_postal' => $codigo_postal,
                'pais' => $pais,
                'descripcion_de_la_empresa' => $descripcion,
                'sitio_web' => $sitio_web,
                'titulo_nombre_persona_responsable' => $responsable_nombre,
                'puesto_persona_responsable' => $responsable_puesto,
                'telefono_persona_responsable' => $responsable_telefono,
                'correo_persona_responsable' => $responsable_correo,
                'carreras_de_interes' => $carrera_interes,
            ]);
            $usuarioEmpleador = UsuariosEmpleador::create([
                'empleadores_rfc' => $rfc,
                'nombre_usuario' => $usuario,
                'password' => Hash::make($password),
            ]);
            
            return view('layouts.homeVinculacion');
        }
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

    public function eliminarResidencia(Request $request)
    {
        $idEliminada = $request->input('idEliminada');
        AsignacionResidencium::where('ofertas_residencia_idoferta', $idEliminada)->delete();
        OfertasResidencium::destroy($idEliminada);
        return view('layouts.homeVinculacion');
    }

    public function mostrarTrabajo($id)
    {
        $oferta = OfertasTrabajo::where('idoferta', $id)->first();
        $asignaciones = AsignacionTrabajo::where('ofertas_trabajo_idoferta', $id)->get();

        return view('usuariosEmpleadores.trabajo', compact('oferta', 'asignaciones'));
    }
    public function eliminarTrabajo(Request $request)
    {
        $idEliminada = $request->input('idEliminada');
        AsignacionTrabajo::where('ofertas_trabajo_idoferta', $idEliminada)->delete();
        OfertasTrabajo::destroy($idEliminada);
        return view('layouts.homeVinculacion');
    }
}
