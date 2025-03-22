<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EncuestaRealizada
 * 
 * @property int $idencuesta_realizada
 * @property int $encuesta_idencuesta
 * @property string $alumno_numero_control
 * @property Carbon|null $fecha_realizacion
 * 
 * @property Encuesta $encuesta
 * @property Alumno $alumno
 * @property Collection|ResultadosEncuestum[] $resultados_encuesta
 *
 * @package App\Models
 */
class EncuestaRealizada extends Model
{
	protected $table = 'encuesta_realizada';
	protected $primaryKey = 'idencuesta_realizada';
	public $timestamps = false;

	protected $casts = [
		'encuesta_idencuesta' => 'int',
		'fecha_realizacion' => 'datetime'
	];

	protected $fillable = [
		'encuesta_idencuesta',
		'alumno_numero_control',
		'fecha_realizacion'
	];

	public function encuesta()
	{
		return $this->belongsTo(Encuesta::class, 'encuesta_idencuesta');
	}

	public function alumno()
	{
		return $this->belongsTo(Alumno::class, 'alumno_numero_control');
	}

	public function resultados_encuesta()
	{
		return $this->hasMany(ResultadosEncuestum::class, 'encuesta_realizada_idencuesta_realizada');
	}
}
