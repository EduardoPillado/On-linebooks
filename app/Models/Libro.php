<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="libro";
    protected $primaryKey='pk_libro';
    protected $fillable = [
        'titulo',
        'descripcion',
        'año_publicacion',
        'imagen_portada',
        'pdf_ruta'
    ];
    public $timestamps=false;
    public function reseña(){
        return $this->hasMany(Reseña::class, 'fk_libro');
    }
    public function libro_autor(){
        return $this->hasMany(Libro_autor::class, 'fk_libro');
    }
    public function libro_genero(){
        return $this->hasMany(Libro_genero::class, 'fk_libro');
    }
    public function favorito(){
        return $this->hasMany(Favorito::class, 'fk_libro');
    }
    public function historial_libro(){
        return $this->hasMany(Historial_libro::class, 'fk_libro');
    }
    public function historial_descarga(){
        return $this->hasMany(Historial_descarga::class, 'fk_libro');
    }
}