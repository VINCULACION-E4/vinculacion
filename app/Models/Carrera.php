<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrera
 * 
 * @property int $idcarrera
 * @property string $nombre
 * @property string|null $clave
 * @property int|null $duracion_semestres
 * @property string|null $modalidad
 * 
 * @property Collection|Alumno[] $alumnos
 * @property Collection|AtributosEgreso[] $atributos_egresos
 *
 * @package App\Models
 */
class Carrera extends Model
{
	protected $table = 'carrera';
	protected $primaryKey = 'idcarrera';
	public $timestamps = false;

	protected $casts = [
		'duracion_semestres' => 'int'
	];

	protected $fillable = [
		'nombre',
		'clave',
		'duracion_semestres',
		'modalidad'
	];

	public function alumnos()
	{
		return $this->hasMany(Alumno::class, 'carrera_idcarrera');
	}

	public function atributos_egresos()
	{
		return $this->hasMany(AtributosEgreso::class, 'carrera_idcarrera');
	}
}
