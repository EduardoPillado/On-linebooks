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
    public function libro_autor(){
        return $this->hasMany(Libro_autor::class, 'fk_autor');
    }
}
