<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="autor";
    protected $primaryKey='pk_autor';
    protected $fillable = [
        'nombre_autor'
    ];
    public $timestamps=false;
    public function libros() {
        return $this->belongsToMany(Libro::class, 'libro_autor', 'fk_libro', 'fk_autor');
    }
}
