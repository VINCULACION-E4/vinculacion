<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\UsuariosAlumno;
use App\Models\UsuariosEmpleador;
use App\Models\UsuariosVinculacion;
use App\Models\Alumno;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register-test');
    }

    public function register(Request $request)
    {
        // Depuración: Registrar los datos recibidos en los logs de Laravel
        Log::info('Datos recibidos en el registro:', $request->all());

        $request->validate([
            'tipo' => 'required',
            'identificador' => 'required|unique:usuarios_alumno,alumno_numero_control',
            'password' => 'required|min:6|confirmed',
            'email' => 'nullable|email',
        ]);

        if ($request->tipo === 'alumno') {
            $numeroControl = trim($request->identificador); // Asegurar que no tenga espacios vacíos
            
            if (empty($numeroControl)) {
                Log::error('Error: número de control vacío.');
                return back()->withErrors(['identificador' => 'Número de control no puede estar vacío.']);
            }
            
            // Depuración: Verificar si el número de control existe antes de insertar
            Log::info('Intentando registrar alumno con número de control:', ['numero_control' => $numeroControl]);
            
            // Verificar si el alumno existe en la tabla alumnos usando el campo correcto
            $alumno = Alumno::where('numero_control', $numeroControl)->first();
            if (!$alumno) {
                
                
                
                
                // Si no existe, crearlo con un valor válido en numero_control
                $alumno = Alumno::create([
                    'numero_control' => $numeroControl,
                    'nombre' => $request->input('nombre_usuario', 'Alumno'),
                    'apellido_paterno' => 'N/A', // Se evita NULL
                    'apellido_materno' => 'N/A', // Se evita NULL
                    'correo_electronico' => 'N/A', // Se evita NULL
                    'numero_telefonico' => '0000000000', // Se evita NULL
                    'semestre_actual' => 1, // Se evita NULL
                    'carrera_idcarrera' => 1, // Se evita NULL
                ]);
                
                // Depuración: Confirmar que se creó el alumno
                Log::info('Alumno creado correctamente:', ['alumno' => $alumno]);
            } else {
                Log::info('Alumno ya existe:', ['alumno' => $alumno]);
            }

            // Registrar el usuario en usuarios_alumno
            UsuariosAlumno::create([
                'alumno_numero_control' => $numeroControl,
                'password' => Hash::make($request->password),
                'nombre_usuario' => $request->input('nombre_usuario', 'Alumno'),
                'estatus_residencia' => 'En proceso', // Valor permitido
                'estatus_estudiante' => 'Residente', // Valor permitido
            ]);
        } elseif ($request->tipo === 'empleador') {
            UsuariosEmpleador::create([
                'rfc' => $request->identificador,
                'password' => Hash::make($request->password),
                'nombre' => $request->input('nombre', 'Empleador'),
            ]);
        } elseif ($request->tipo === 'vinculacion') {
            UsuariosVinculacion::create([
                'nombre' => $request->identificador,
                'password' => Hash::make($request->password),
            ]);
        } else {
            return back()->withErrors(['tipo' => 'Tipo de usuario inválido.']);
        }

        return redirect('/login')->with('success', 'Registro exitoso, ahora puedes iniciar sesión.');
    }
}
