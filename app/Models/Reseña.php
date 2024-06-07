<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="reseña";
    protected $primaryKey='pk_reseña';
    protected $fillable = [
        'fk_usuario',
        'fk_libro',
        'valoracion',
        'comentario',
        'fecha_reseña'
    ];
    public $timestamps=false;
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'fk_usuario');
    }
    public function libro(){
        return $this->belongsTo(Libro::class, 'fk_libro');
    }
}
