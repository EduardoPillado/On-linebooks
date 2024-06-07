<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_descarga extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="historial_descarga";
    protected $primaryKey='pk_historial_descarga';
    protected $fillable = [
        'fk_usuario',
        'fk_libro'
    ];
    public $timestamps=false;
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'fk_usuario');
    }
    public function libro(){
        return $this->belongsTo(Libro::class, 'fk_libro');
    }
}
