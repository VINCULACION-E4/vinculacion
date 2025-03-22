<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultadosEncuestum
 * 
 * @property int $idresultado
 * @property int $reporte_idreporte
 * @property int $encuesta_realizada_idencuesta_realizada
 * 
 * @property Reporte $reporte
 * @property EncuestaRealizada $encuesta_realizada
 *
 * @package App\Models
 */
class ResultadosEncuestum extends Model
{
	protected $table = 'resultados_encuesta';
	protected $primaryKey = 'idresultado';
	public $timestamps = false;

	protected $casts = [
		'reporte_idreporte' => 'int',
		'encuesta_realizada_idencuesta_realizada' => 'int'
	];

	protected $fillable = [
		'reporte_idreporte',
		'encuesta_realizada_idencuesta_realizada'
	];

	public function reporte()
	{
		return $this->belongsTo(Reporte::class, 'reporte_idreporte');
	}

	public function encuesta_realizada()
	{
		return $this->belongsTo(EncuestaRealizada::class, 'encuesta_realizada_idencuesta_realizada');
	}
}
