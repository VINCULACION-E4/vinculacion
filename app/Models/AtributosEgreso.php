<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtributosEgreso
 * 
 * @property int $idatributosegreso
 * @property string|null $competencias
 * @property string|null $habilidades
 * @property string|null $tecnologias_dominadas
 * @property int $carrera_idcarrera
 * 
 * @property Carrera $carrera
 *
 * @package App\Models
 */
class AtributosEgreso extends Model
{
	protected $table = 'atributos_egreso';
	protected $primaryKey = 'idatributosegreso';
	public $timestamps = false;

	protected $casts = [
		'carrera_idcarrera' => 'int'
	];

	protected $fillable = [
		'competencias',
		'habilidades',
		'tecnologias_dominadas',
		'carrera_idcarrera'
	];

	public function carrera()
	{
		return $this->belongsTo(Carrera::class, 'carrera_idcarrera');
	}
}
