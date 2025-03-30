<?php

/**
 * Created by Reliese Model.
 */

 namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;  // Extiende la clase User de Laravel
 use Illuminate\Contracts\Auth\Authenticatable;
 use Illuminate\Database\Eloquent\Collection;
 use Illuminate\Database\Eloquent\Model;

 
 /**
  * Class UsuariosVinculacion
  * 
  * @property int $idusuario_vinculacion
  * @property string|null $nombre
  * @property string|null $apellido_paterno
  * @property string|null $apellido_materno
  * @property USER-DEFINED|null $rol
  * @property string|null $password
  * @property string|null $nombre_usuario
  * 
  * @property Collection|Encuesta[] $encuestas
  * @property Collection|Reporte[] $reportes
  *
  * @package App\Models
  */
  class UsuariosVinculacion extends Model implements Authenticatable  // Extiende de Authenticatable
 {
	use \Illuminate\Auth\Authenticatable;
	 protected $table = 'usuarios_vinculacion';
	 protected $primaryKey = 'idusuario_vinculacion';
	 public $timestamps = false;
 
	 protected $casts = [
		 'rol' => 'string'
	 ];
 
	 protected $hidden = [
		 'password'
	 ];
 
	 protected $fillable = [
		 'nombre',
		 'apellido_paterno',
		 'apellido_materno',
		 'rol',
		 'password',
		 'nombre_usuario'
	 ];
 
	 // Relación con Encuesta
	 public function encuestas()
	 {
		 return $this->hasMany(Encuesta::class, 'usuario_cordinacion_idusuario_cordinacion');
	 }
 
	 // Relación con Reporte
	 public function reportes()
	 {
		 return $this->hasMany(Reporte::class, 'usuario_cordinacion_idusuario_cordinacion');
	 }
 
	 // Métodos requeridos para la autenticación
	 public function getAuthPassword()
	 {
		 return $this->password;  // Retorna la contraseña que se almacena en la base de datos
	 }
 }
 