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
<<<<<<< HEAD
=======
 * @property int $idencuesta
>>>>>>> origin/CRIS
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
<<<<<<< HEAD
		'respuestas_idrespuestas' => 'int'
=======
		'respuestas_idrespuestas' => 'int',
		'idencuesta' => 'int'
>>>>>>> origin/CRIS
	];

	protected $fillable = [
		'preguntas_idpreguntas',
<<<<<<< HEAD
		'respuestas_idrespuestas'
=======
		'respuestas_idrespuestas',
		'idencuesta'
>>>>>>> origin/CRIS
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
