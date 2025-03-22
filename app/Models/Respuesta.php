<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Respuesta
 * 
 * @property int $idrespuestas
 * @property string|null $texto
 * 
 * @property Collection|Pregunta[] $preguntas
 *
 * @package App\Models
 */
class Respuesta extends Model
{
	protected $table = 'respuestas';
	protected $primaryKey = 'idrespuestas';
	public $timestamps = false;

	protected $fillable = [
		'texto'
	];

	public function preguntas()
	{
		return $this->belongsToMany(Pregunta::class, 'respuestas_preguntas', 'respuestas_idrespuestas', 'preguntas_idpreguntas')
					->withPivot('idrespuestas_preguntas');
	}
}
