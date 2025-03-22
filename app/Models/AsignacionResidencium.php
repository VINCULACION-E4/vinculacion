<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignacionResidencium
 * 
 * @property int $idasignacion_residencia
 * @property Carbon|null $fecha_asignacion
 * @property int $ofertas_residencia_idoferta
 * @property int $usuarios_alumno_idusuarios_alumno
 * 
 * @property OfertasResidencium $ofertas_residencium
 * @property UsuariosAlumno $usuarios_alumno
 *
 * @package App\Models
 */
class AsignacionResidencium extends Model
{
	protected $table = 'asignacion_residencia';
	protected $primaryKey = 'idasignacion_residencia';
	public $timestamps = false;

	protected $casts = [
		'fecha_asignacion' => 'datetime',
		'ofertas_residencia_idoferta' => 'int',
		'usuarios_alumno_idusuarios_alumno' => 'int'
	];

	protected $fillable = [
		'fecha_asignacion',
		'ofertas_residencia_idoferta',
		'usuarios_alumno_idusuarios_alumno'
	];

	public function ofertas_residencium()
	{
		return $this->belongsTo(OfertasResidencium::class, 'ofertas_residencia_idoferta');
	}

	public function usuarios_alumno()
	{
		return $this->belongsTo(UsuariosAlumno::class, 'usuarios_alumno_idusuarios_alumno');
	}
}
