<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignacionTrabajo
 * 
 * @property int $idasignacion_residencia
 * @property int $ofertas_trabajo_idoferta
 * @property Carbon|null $fecha_asignacion
 * @property int $usuarios_alumno_idusuarios_alumno
 * 
 * @property OfertasTrabajo $ofertas_trabajo
 * @property UsuariosAlumno $usuarios_alumno
 *
 * @package App\Models
 */
class AsignacionTrabajo extends Model
{
	protected $table = 'asignacion_trabajo';
	protected $primaryKey = 'idasignacion_residencia';
	public $timestamps = false;

	protected $casts = [
		'ofertas_trabajo_idoferta' => 'int',
		'fecha_asignacion' => 'datetime',
		'usuarios_alumno_idusuarios_alumno' => 'int'
	];

	protected $fillable = [
		'ofertas_trabajo_idoferta',
		'fecha_asignacion',
		'usuarios_alumno_idusuarios_alumno'
	];

	public function ofertas_trabajo()
	{
		return $this->belongsTo(OfertasTrabajo::class, 'ofertas_trabajo_idoferta');
	}

	public function usuarios_alumno()
	{
		return $this->belongsTo(UsuariosAlumno::class, 'usuarios_alumno_idusuarios_alumno');
	}
}
