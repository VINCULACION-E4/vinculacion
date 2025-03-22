<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuariosAlumno
 * 
 * @property int $idusuarios_alumno
 * @property string $alumno_numero_control
 * @property USER-DEFINED|null $estatus_residencia
 * @property string|null $nombre_usuario
 * @property string|null $password
 * @property USER-DEFINED|null $estatus_estudiante
 * 
 * @property Alumno $alumno
 * @property Collection|AsignacionTrabajo[] $asignacion_trabajos
 * @property Collection|AsignacionResidencium[] $asignacion_residencia
 *
 * @package App\Models
 */
class UsuariosAlumno extends Model
{
	protected $table = 'usuarios_alumno';
	protected $primaryKey = 'idusuarios_alumno';
	public $timestamps = false;

	protected $casts = [
		'estatus_residencia' => 'USER-DEFINED',
		'estatus_estudiante' => 'USER-DEFINED'
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
