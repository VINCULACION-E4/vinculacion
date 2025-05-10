<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FocusGroup
 * 
 * @property int $id_focus_group
 * @property Carbon $fecha
 * @property string $titulo
 * @property string|null $descripcion
 * @property int|null $usuarios_vinculacion_idusuario_vinculacion
 * 
 * @property UsuariosVinculacion|null $usuarios_vinculacion
 * @property Collection|MensajeGrupo[] $mensaje_grupos
 *
 * @package App\Models
 */
class FocusGroup extends Model
{
	protected $table = 'focus_group';
	protected $primaryKey = 'id_focus_group';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'usuarios_vinculacion_idusuario_vinculacion' => 'int'
	];

	protected $fillable = [
		'fecha',
		'titulo',
		'descripcion',
		'usuarios_vinculacion_idusuario_vinculacion'
	];

	public function usuarios_vinculacion()
	{
		return $this->belongsTo(UsuariosVinculacion::class, 'usuarios_vinculacion_idusuario_vinculacion');
	}

	public function mensaje_grupos()
	{
		return $this->hasMany(MensajeGrupo::class, 'focus_group_id_focus_group');
	}
}
