<?php

namespace App\Http\Controllers;
use App\Models\UsuariosAlumno;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function update()
    {
        $user = UsuariosAlumno::where('alumno_numero_control', '20230001')->first();
        $user->nombre_usuario = 'juanin';
        $user->save(); 
        return 'Update method called';
    }
}
