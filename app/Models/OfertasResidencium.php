<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfertasResidencium
 * 
 * @property int $idoferta
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $ubicacion
 * @property int|null $vacantes_disponibles
 * @property float|null $salario
 * @property string|null $area_residencia
 * @property string|null $carrera_solicitada
 * @property int $usuarios_empleador_idusuarios_empleador
 * 
 * @property UsuariosEmpleador $usuarios_empleador
 * @property Collection|AsignacionResidencium[] $asignacion_residencia
 *
 * @package App\Models
 */
class OfertasResidencium extends Model
{
	protected $table = 'ofertas_residencia';
	protected $primaryKey = 'idoferta';
	public $timestamps = false;

	protected $casts = [
		'vacantes_disponibles' => 'int',
		'salario' => 'float',
		'usuarios_empleador_idusuarios_empleador' => 'int'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'ubicacion',
		'vacantes_disponibles',
		'salario',
		'area_residencia',
		'carrera_solicitada',
		'usuarios_empleador_idusuarios_empleador'
	];

	public function usuarios_empleador()
	{
		return $this->belongsTo(UsuariosEmpleador::class, 'usuarios_empleador_idusuarios_empleador');
	}

	public function asignacion_residencia()
	{
		return $this->hasMany(AsignacionResidencium::class, 'ofertas_residencia_idoferta');
	}
}
