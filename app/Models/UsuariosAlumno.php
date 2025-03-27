<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuariosAlumno extends Authenticatable
{
    use Notifiable;

=======
=======
>>>>>>> origin/CRIS
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
<<<<<<< HEAD
>>>>>>> origin/ADOLFO
=======
>>>>>>> origin/CRIS
	protected $table = 'usuarios_alumno';
	protected $primaryKey = 'idusuarios_alumno';
	public $timestamps = false;

	protected $casts = [
<<<<<<< HEAD
<<<<<<< HEAD
		'estatus_residencia' => 'string',
		'estatus_estudiante' => 'string'
	];
	
=======
		'estatus_residencia' => 'USER-DEFINED',
		'estatus_estudiante' => 'USER-DEFINED'
	];
>>>>>>> origin/ADOLFO
=======
		'estatus_residencia' => 'string',
		'estatus_estudiante' => 'string'
	];
>>>>>>> origin/CRIS

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
