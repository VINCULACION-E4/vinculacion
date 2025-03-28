<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfertasTrabajo
 * 
 * @property int $idoferta
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $ubicacion
 * @property int|null $vacantes_disponibles
 * @property float|null $salario
 * @property string|null $area_trabajo
 * @property string|null $carrera_solicitada
 * @property int $usuarios_empleador_idusuarios_empleador

 * @property USER-DEFINED|null $estado

 * 
 * @property UsuariosEmpleador $usuarios_empleador
 * @property Collection|AsignacionTrabajo[] $asignacion_trabajos
 *
 * @package App\Models
 */
class OfertasTrabajo extends Model
{
	protected $table = 'ofertas_trabajo';
	protected $primaryKey = 'idoferta';
	public $timestamps = false;

	protected $casts = [
		'vacantes_disponibles' => 'int',
		'salario' => 'float',
		'usuarios_empleador_idusuarios_empleador' => 'int',
		'estado' => 'string',
		'usuarios_empleador_idusuarios_empleador' => 'int'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'ubicacion',
		'vacantes_disponibles',
		'salario',
		'area_trabajo',
		'carrera_solicitada',
		'usuarios_empleador_idusuarios_empleador',
		'estado',
		'usuarios_empleador_idusuarios_empleador'
	];

	public function usuarios_empleador()
	{
		return $this->belongsTo(UsuariosEmpleador::class, 'usuarios_empleador_idusuarios_empleador');
	}

	public function asignacion_trabajos()
	{
		return $this->hasMany(AsignacionTrabajo::class, 'ofertas_trabajo_idoferta');
	}
}
