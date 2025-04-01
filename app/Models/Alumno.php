<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alumno
 * 
 * @property string $numero_control
 * @property string $nombre
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property string|null $correo_electronico
 * @property string|null $numero_telefonico
 * @property int|null $semestre_actual
 * @property int $carrera_idcarrera
 * 
 * @property Carrera $carrera
 * @property Collection|UsuariosAlumno[] $usuarios_alumnos
 * @property Collection|EncuestaRealizada[] $encuesta_realizadas
 *
 * @package App\Models
 */
class Alumno extends Model
{
	protected $table = 'alumnos';
	protected $primaryKey = 'numero_control';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'semestre_actual' => 'int',
		'carrera_idcarrera' => 'int'
	];

	protected $fillable = [

		'numero_control', 
		'nombre',
		'apellido_paterno',
		'apellido_materno',
		'correo_electronico',
		'numero_telefonico',
		'semestre_actual',
		'carrera_idcarrera'
	];

	public function carrera()
	{
		return $this->belongsTo(Carrera::class, 'carrera_idcarrera');
	}

	public function usuarios_alumnos()
	{
		return $this->hasMany(UsuariosAlumno::class, 'alumno_numero_control');
	}

	public function encuesta_realizadas()
	{
		return $this->hasMany(EncuestaRealizada::class, 'alumno_numero_control');
	}
}
