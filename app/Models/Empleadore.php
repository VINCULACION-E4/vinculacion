<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleadore
 * 
 * @property string $rfc
 * @property string|null $logo_url
 * @property string|null $nombre_comercial
 * @property string|null $razon_social
 * @property string|null $tipo_de_empresa
 * @property string|null $sector
 * @property string|null $giro
 * @property int|null $numero_empleados
 * @property string|null $direccion_empresa
 * @property string|null $colonia
 * @property string|null $ciudad
 * @property string|null $estado
 * @property string|null $codigo_postal
 * @property string|null $pais
 * @property string|null $descripcion_de_la_empresa
 * @property string|null $sitio_web
 * @property string|null $titulo_nombre_persona_responsable
 * @property string|null $puesto_persona_responsable
 * @property string|null $telefono_persona_responsable
 * @property string|null $correo_persona_responsable
 * @property USER-DEFINED|null $carreras_de_interes
 * 
 * @property Collection|UsuariosEmpleador[] $usuarios_empleadors
 *
 * @package App\Models
 */
class Empleadore extends Model
{
	protected $table = 'empleadores';
	protected $primaryKey = 'rfc';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'numero_empleados' => 'int',
<<<<<<< HEAD
		'carreras_de_interes' => 'USER-DEFINED'
	];

	protected $fillable = [
=======
		'carreras_de_interes' => 'string'
	];

	protected $fillable = [
		'rfc',
>>>>>>> origin/CRIS
		'logo_url',
		'nombre_comercial',
		'razon_social',
		'tipo_de_empresa',
		'sector',
		'giro',
		'numero_empleados',
		'direccion_empresa',
		'colonia',
		'ciudad',
		'estado',
		'codigo_postal',
		'pais',
		'descripcion_de_la_empresa',
		'sitio_web',
		'titulo_nombre_persona_responsable',
		'puesto_persona_responsable',
		'telefono_persona_responsable',
		'correo_persona_responsable',
		'carreras_de_interes'
	];

	public function usuarios_empleadors()
	{
		return $this->hasMany(UsuariosEmpleador::class, 'empleadores_rfc');
	}
}
