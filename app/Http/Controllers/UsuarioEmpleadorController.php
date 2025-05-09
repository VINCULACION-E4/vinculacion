<?php

namespace App\Http\Controllers;

use App\Models\OfertasResidencium;
use App\Models\OfertasTrabajo;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

    public function actualizarEmpleador(Request $request, $id)
    {
        $empleador = Empleadore::where('rfc', $id)->first();
        if ($empleador) {
            $empleador->nombre_comercial = $request->input('nombre_comercial');
            $empleador->descripcion_de_la_empresa = $request->input('descripcion_de_la_empresa');
            $empleador->correo_persona_responsable = $request->input('correo_persona_responsable');
            $empleador->telefono_persona_responsable = $request->input('telefono_persona_responsable');
            $empleador->sitio_web = $request->input('sitio_web');

            $empleador->razon_social = $request->input('razon_social');
            $empleador->tipo_de_empresa = $request->input('tipo_empresa');
            $empleador->sector = $request->input('sector');
            $empleador->giro = $request->input('giro');
            $empleador->numero_empleados = $request->input('numero_empleados');
            $empleador->direccion_empresa = $request->input('direccion_empresa');
            $empleador->colonia = $request->input('colonia');
            $empleador->ciudad = $request->input('ciudad');
            $empleador->estado = $request->input('estado');
            $empleador->codigo_postal = $request->input('codigo_postal');
            $empleador->pais = $request->input('pais');
            $empleador -> save();
            return view ('usuariosEmpleadores.confirmar')->with('success', 'Empleador actualizado correctamente.');
        }
        return view('usuariosEmpleadores.index')->with('error', 'Empleador no encontrado.');
    }

    public function eliminarEmpleador($id)
    {
        $empleador = Empleadore::where('rfc', $id)->first();
        $usuarioEmpleador = $empleador->usuarios_empleadors;
        if ($empleador) {
            foreach ($empleador->usuarios_empleadors as $usuarioEmpleador) {
                // Borrar asignaciones y ofertas de residencia
                foreach ($usuarioEmpleador->ofertas_residencia as $ofertaResidencia) {
                    $ofertaResidencia->asignacion_residencia()->delete();
                    $ofertaResidencia->delete();
                }
            
                // Borrar asignaciones y ofertas de trabajo
                foreach ($usuarioEmpleador->ofertas_trabajos as $ofertaTrabajo) {
                    $ofertaTrabajo->asignacion_trabajos()->delete();
                    $ofertaTrabajo->delete();
                }
            
                // Borrar el usuario empleador
                $usuarioEmpleador->delete();
            }
            $empleadores = UsuariosEmpleador::where('nombre_usuario', 'like', '%' . $search . '%')
                            ->orWhereHas('empleadore', function($query) use ($search) {
                                $query->where('nombre_comercial', 'like', '%' . $search . '%');
                            })
                        ->get();
            return view('usuariosEmpleadores.index', compact('empleadores'));
        }
        return view ('usuariosEmpleadores.index')->with('error', 'Empleador no encontrado.');
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

    public function empleadoresCSV()
    {
        // Cargar los datos con relaciones (si las hay)
        $empleadores = UsuariosEmpleador::all();
        
        // Cabeceras del CSV
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="empleadores.csv"',
        ];

        // Generar el CSV
        $callback = function() use ($empleadores) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            // Escribir las cabeceras
            fputcsv($handle, [
                'RFC',
                'Nombre Comercial',
                'Razón Social',
                'Tipo de Empresa',
                'Sector',
                'Giro',
                'Número de Empleados',
                'Dirección',
                'Colonia',
                'Ciudad',
                'Estado',
                'Código Postal',
                'País',
                'Descripción de la Empresa',
                'Sitio Web'
            ]);
            
            // Escribir los datos
            foreach ($empleadores as $empleador) {
                fputcsv($handle, [
                    $empleador->empleadore->rfc ?? '',
                    $empleador->empleadore->nombre_comercial ?? '',
                    $empleador->empleadore->razon_social ?? '',
                    $empleador->empleadore->tipo_de_empresa ?? '',
                    $empleador->empleadore->sector ?? '',
                    $empleador->empleadore->giro ?? '',
                    $empleador->empleadore->numero_empleados ?? '',
                    $empleador->empleadore->direccion_empresa ?? '',
                    $empleador->empleadore->colonia ?? '',
                    $empleador->empleadore->ciudad ?? '',
                    $empleador->empleadore->estado ?? '',
                    $empleador->empleadore->codigo_postal ?? '',
                    $empleador->empleadore->pais ?? '',
                    $empleador->empleadore->descripcion_de_la_empresa ?? '',
                    $empleador->empleadore->sitio_web ?? ''
                ]);
            }
            
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
