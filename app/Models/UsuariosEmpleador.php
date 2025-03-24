<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuariosEmpleador
 * 
 * @property int $idusuarios_empleador
 * @property string|null $password
 * @property string|null $nombre_usuario
 * @property string $empleadores_rfc
 * 
 * @property Empleadore $empleadore
 * @property Collection|OfertasResidencium[] $ofertas_residencia
 * @property Collection|OfertasTrabajo[] $ofertas_trabajos
 *
 * @package App\Models
 */
class UsuariosEmpleador extends Model
{
	protected $table = 'usuarios_empleador';
	protected $primaryKey = 'idusuarios_empleador';
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'password',
		'nombre_usuario',
		'empleadores_rfc'
	];

	public function empleadore()
	{
		return $this->belongsTo(Empleadore::class, 'empleadores_rfc');
	}

	public function ofertas_residencia()
	{
		return $this->hasMany(OfertasResidencium::class, 'usuarios_empleador_idusuarios_empleador');
	}

	public function ofertas_trabajos()
	{
		return $this->hasMany(OfertasTrabajo::class, 'usuarios_empleador_idusuarios_empleador');
	}
}
