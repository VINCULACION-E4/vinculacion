<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PreguntasEncuesta
 * 
 * @property int $idpreguntas_encuestas
 * @property int $encuestas_idencuesta
 * @property int $preguntas_idpreguntas
 * 
 * @property Encuesta $encuesta
 * @property Pregunta $pregunta
 *
 * @package App\Models
 */
class PreguntasEncuesta extends Model
{
	protected $table = 'preguntas_encuestas';
	protected $primaryKey = 'idpreguntas_encuestas';
	public $timestamps = false;

	protected $casts = [
		'encuestas_idencuesta' => 'int',
		'preguntas_idpreguntas' => 'int'
	];

	protected $fillable = [
		'encuestas_idencuesta',
		'preguntas_idpreguntas'
	];

	public function encuesta()
	{
		return $this->belongsTo(Encuesta::class, 'encuestas_idencuesta');
	}

	public function pregunta()
	{
		return $this->belongsTo(Pregunta::class, 'preguntas_idpreguntas');
	}
}
