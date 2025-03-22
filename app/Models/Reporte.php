<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporte
 * 
 * @property int $idreporte
 * @property int $usuario_cordinacion_idusuario_cordinacion
 * @property string|null $titulo
 * @property string|null $descripcion
 * 
 * @property UsuariosVinculacion $usuarios_vinculacion
 * @property Collection|ResultadosEncuestum[] $resultados_encuesta
 *
 * @package App\Models
 */
class Reporte extends Model
{
	protected $table = 'reportes';
	protected $primaryKey = 'idreporte';
	public $timestamps = false;

	protected $casts = [
		'usuario_cordinacion_idusuario_cordinacion' => 'int'
	];

	protected $fillable = [
		'usuario_cordinacion_idusuario_cordinacion',
		'titulo',
		'descripcion'
	];

	public function usuarios_vinculacion()
	{
		return $this->belongsTo(UsuariosVinculacion::class, 'usuario_cordinacion_idusuario_cordinacion');
	}

	public function resultados_encuesta()
	{
		return $this->hasMany(ResultadosEncuestum::class, 'reporte_idreporte');
	}
}
