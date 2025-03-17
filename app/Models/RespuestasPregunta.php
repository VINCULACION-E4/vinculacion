<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RespuestasPregunta
 * 
 * @property int $idrespuestas_preguntas
 * @property int $preguntas_idpreguntas
 * @property int $respuestas_idrespuestas
 * 
 * @property Pregunta $pregunta
 * @property Respuesta $respuesta
 *
 * @package App\Models
 */
class RespuestasPregunta extends Model
{
	protected $table = 'respuestas_preguntas';
	protected $primaryKey = 'idrespuestas_preguntas';
	public $timestamps = false;

	protected $casts = [
		'preguntas_idpreguntas' => 'int',
		'respuestas_idrespuestas' => 'int'
	];

	protected $fillable = [
		'preguntas_idpreguntas',
		'respuestas_idrespuestas'
	];

	public function pregunta()
	{
		return $this->belongsTo(Pregunta::class, 'preguntas_idpreguntas');
	}

	public function respuesta()
	{
		return $this->belongsTo(Respuesta::class, 'respuestas_idrespuestas');
	}
}
