<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\UsuariosAlumno;
use App\Models\UsuariosEmpleador;
use App\Models\UsuariosVinculacion;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        Auth::logout();
        Log::info('Intento de inicio de sesión:', $request->all());
        
        $tipo = $request->tipo;
        $credentials = ['password' => $request->password];

        if ($tipo === 'alumno') {
            $credentials['alumno_numero_control'] = $request->identificador;
            $user = UsuariosAlumno::where('alumno_numero_control', $credentials['alumno_numero_control'])->first();
        } elseif ($tipo === 'empleador') {
            $credentials['RFC'] = $request->identificador;
            $user = UsuariosEmpleador::where('empleadores_rfc', $credentials['RFC'])->first();
        } elseif ($tipo === 'vinculacion') {
            $credentials['nombre_usuario'] = $request->identificador;
            $user = UsuariosVinculacion::where('nombre_usuario', $credentials['nombre_usuario'])->first();
            
        } else {
            Log::error('Tipo de usuario inválido', ['tipo' => $tipo]);
            return back()->withErrors(['tipo' => 'Tipo de usuario inválido.']);
        }

        if (!$user) {
            Log::error('Usuario no encontrado', ['tipo' => $tipo, 'identificador' => $request->identificador]);
            return back()->withErrors(['identificador' => 'Usuario no encontrado.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            Log::error('Contraseña incorrecta', ['identificador' => $request->identificador]);
            return back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }
        
        if ($user) {
            if ($tipo === 'alumno') {
                Auth::guard('usuarios_alumno')->login($user);
                $request->session()->regenerate();
                $userAl = Auth::guard('usuarios_alumno')->user();
                return redirect('/dashboard/encuestas');
            } elseif ($tipo === 'empleador') {
                Auth::guard('empleador')->login($user);   
                $request->session()->regenerate();
                return redirect('/dashboardEmpresa');
            } elseif ($tipo === 'vinculacion') {
                Auth::guard('vinculacion')->login($user);
                $request->session()->regenerate();
                return redirect('/mostrarAlumnos');
            }
           
            // Verifica el contenido de $authUser
            //Log::info('Usuario autenticado:', ['authUser' => $authUser]);
            //return $userVin->nombre_usuario;
            
            // Pasa $authUser a la vista
            //return redirect('/mostrarAlumnos')->with('authUser', $authUser);
        }
        /*
        if ($tipo === 'alumno') {
            return redirect('/dashboard/alumno');
        } elseif ($tipo === 'empleador') {
            return redirect('/dashboard/empleador');
        } elseif ($tipo === 'vinculacion') {
            return redirect('/mostrarAlumnos');
        }*/
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
