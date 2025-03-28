<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuariosAlumno extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios_alumno';
    protected $primaryKey = 'idusuarios_alumno';
    public $timestamps = false;

    protected $casts = [
        'estatus_residencia' => 'string',
        'estatus_estudiante' => 'string',
    ];

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'alumno_numero_control',
        'estatus_residencia',
        'nombre_usuario',
        'password',
        'estatus_estudiante'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_numero_control');
    }

    public function asignacion_trabajos()
    {
        return $this->hasMany(AsignacionTrabajo::class, 'usuarios_alumno_idusuarios_alumno');
    }

    public function asignacion_residencia()
    {
        return $this->hasMany(AsignacionResidencium::class, 'usuarios_alumno_idusuarios_alumno');
    }
}
