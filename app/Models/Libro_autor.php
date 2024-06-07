<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro_autor extends Model
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table="libro_autor";
    protected $primaryKey='pk_libro_autor';
    protected $fillable = [
        'fk_libro',
        'fk_autor'
    ];
    public $timestamps=false;
    public function libro(){
        return $this->belongsTo(Libro::class, 'fk_libro');
    }
    public function autor(){
        return $this->belongsTo(Autor::class, 'fk_autor');
    }
}
