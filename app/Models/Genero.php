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
    public function libro_genero(){
        return $this->hasMany(Libro_genero::class, 'fk_genero');
    }
}
