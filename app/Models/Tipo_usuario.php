<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="tipo_usuario";
    protected $primaryKey='pk_tipo_usuario';
    protected $fillable = [
        'nombre_tipo_usuario'
    ];
    public $timestamps=false;
    public function usuario(){
        return $this->hasMany(Usuario::class, 'fk_tipo_usuario');
    }
}
