<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="genero";
    protected $primaryKey='pk_genero';
    protected $fillable = [
        'nombre_genero'
    ];
    public $timestamps=false;
    public function libros(){
        return $this->belongsToMany(Libro::class, 'libro_genero', 'fk_genero', 'fk_libro');
    }
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_genero', 'fk_genero', 'fk_libro');
    }
}
