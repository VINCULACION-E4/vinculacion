<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pregunta
 * 
 * @property int $idpreguntas
 * @property string|null $texto
 * 
 * @property Collection|Encuesta[] $encuestas
 * @property Collection|Respuesta[] $respuestas
 *
 * @package App\Models
 */
class Pregunta extends Model
{
	protected $table = 'preguntas';
	protected $primaryKey = 'idpreguntas';
	public $timestamps = false;

	protected $fillable = [
		'texto'
	];

	public function encuestas()
	{
		return $this->belongsToMany(Encuesta::class, 'preguntas_encuestas', 'preguntas_idpreguntas', 'encuestas_idencuesta')
					->withPivot('idpreguntas_encuestas');
	}

	public function respuestas()
	{
		return $this->belongsToMany(Respuesta::class, 'respuestas_preguntas', 'preguntas_idpreguntas', 'respuestas_idrespuestas')
					->withPivot('idrespuestas_preguntas');
	}
}
