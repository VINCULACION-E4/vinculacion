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
        Log::info('Intento de inicio de sesión:', $request->all());
        
        $tipo = $request->tipo;
        $credentials = ['password' => $request->password];

        if ($tipo === 'alumno') {
            $credentials['alumno_numero_control'] = $request->identificador;
            $user = UsuariosAlumno::where('alumno_numero_control', $credentials['alumno_numero_control'])->first();
        } elseif ($tipo === 'empleador') {
            $credentials['rfc'] = $request->identificador;
            $user = UsuariosEmpleador::where('rfc', $credentials['rfc'])->first();
        } elseif ($tipo === 'vinculacion') {
            $credentials['nombre'] = $request->identificador;
            $user = UsuariosVinculacion::where('nombre', $credentials['nombre'])->first();
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

        if (!$user instanceof \Illuminate\Contracts\Auth\Authenticatable) {
            Log::error('El usuario no implementa Authenticatable', ['identificador' => $request->identificador]);
            return back()->withErrors(['error' => 'El usuario no puede autenticarse.']);
        }

        Auth::login($user);
        Log::info('Inicio de sesión exitoso', ['identificador' => $request->identificador]);

        if ($tipo === 'alumno') {
            return redirect('/dashboard/alumno');
        } elseif ($tipo === 'empleador') {
            return redirect('/dashboard/empleador');
        } elseif ($tipo === 'vinculacion') {
            return redirect('/dashboard/vinculacion');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
