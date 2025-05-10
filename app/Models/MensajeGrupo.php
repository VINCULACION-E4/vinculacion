<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MensajeGrupo
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property int|null $mensaje_id_mensaje
 * @property int|null $focus_group_id_focus_group
 * 
 * @property Mensaje|null $mensaje
 * @property FocusGroup|null $focus_group
 *
 * @package App\Models
 */
class MensajeGrupo extends Model
{
	protected $table = 'mensaje_grupo';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'mensaje_id_mensaje' => 'int',
		'focus_group_id_focus_group' => 'int'
	];

	protected $fillable = [
		'fecha',
		'mensaje_id_mensaje',
		'focus_group_id_focus_group'
	];

	public function mensaje()
	{
		return $this->belongsTo(Mensaje::class, 'mensaje_id_mensaje');
	}

	public function focus_group()
	{
		return $this->belongsTo(FocusGroup::class, 'focus_group_id_focus_group');
	}
}
