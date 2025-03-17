<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Encuesta
 * 
 * @property int $idencuesta
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property int $usuario_cordinacion_idusuario_cordinacion
 * 
 * @property UsuariosVinculacion $usuarios_vinculacion
 * @property Collection|EncuestaRealizada[] $encuesta_realizadas
 * @property Collection|Pregunta[] $preguntas
 *
 * @package App\Models
 */
class Encuesta extends Model
{
	protected $table = 'encuestas';
	protected $primaryKey = 'idencuesta';
	public $timestamps = false;

	protected $casts = [
		'usuario_cordinacion_idusuario_cordinacion' => 'int'
	];

	protected $fillable = [
		'titulo',
		'descripcion',
		'usuario_cordinacion_idusuario_cordinacion'
	];

	public function usuarios_vinculacion()
	{
		return $this->belongsTo(UsuariosVinculacion::class, 'usuario_cordinacion_idusuario_cordinacion');
	}

	public function encuesta_realizadas()
	{
		return $this->hasMany(EncuestaRealizada::class, 'encuesta_idencuesta');
	}

	public function preguntas()
	{
		return $this->belongsToMany(Pregunta::class, 'preguntas_encuestas', 'encuestas_idencuesta', 'preguntas_idpreguntas')
					->withPivot('idpreguntas_encuestas');
	}
}
