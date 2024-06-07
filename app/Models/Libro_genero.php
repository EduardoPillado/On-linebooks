<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro_genero extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="libro_genero";
    protected $primaryKey='pk_libro_genero';
    protected $fillable = [
        'fk_libro',
        'fk_genero'
    ];
    public $timestamps=false;
    public function libro(){
        return $this->belongsTo(Libro::class, 'fk_libro');
    }
    public function genero(){
        return $this->belongsTo(Genero::class, 'fk_genero');
    }
}
