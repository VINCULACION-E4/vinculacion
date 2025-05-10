<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensaje
 * 
 * @property int $id_mensaje
 * @property string $texto
 * @property string|null $nombre_usuario
 * @property USER-DEFINED|null $tipo_usuario
 * 
 * @property Collection|MensajeGrupo[] $mensaje_grupos
 *
 * @package App\Models
 */
class Mensaje extends Model
{
	protected $table = 'mensaje';
	protected $primaryKey = 'id_mensaje';
	public $timestamps = false;

	protected $casts = [
		'tipo_usuario' => 'string'
	];

	protected $fillable = [
		'texto',
		'nombre_usuario',
		'tipo_usuario'
	];

	public function mensaje_grupos()
	{
		return $this->hasMany(MensajeGrupo::class, 'mensaje_id_mensaje');
	}
}
