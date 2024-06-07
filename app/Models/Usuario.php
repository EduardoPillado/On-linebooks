<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    // use HasRoles;
    protected $guard_name = 'web';
    protected $table="usuario";
    protected $primaryKey='pk_usuario';
    protected $fillable = [
        'nombre_usuario',
        'correo',
        'contraseña',
        'fk_tipo_usuario',
        'token',
        'estatus_usuario'
    ];
    public $timestamps=false;
    public function tipo_usuario(){
        return $this->belongsTo(Tipo_usuario::class, 'fk_tipo_usuario');
    }
    public function reseña(){
        return $this->hasMany(Reseña::class, 'fk_usuario');
    }
    public function favorito(){
        return $this->hasMany(Favorito::class, 'fk_usuario');
    }
    public function historial_libro(){
        return $this->hasMany(Historial_libro::class, 'fk_usuario');
    }
    public function historial_descarga(){
        return $this->hasMany(Historial_descarga::class, 'fk_usuario');
    }
}
