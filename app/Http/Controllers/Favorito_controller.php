<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favorito;

use App\Models\Libro;

class Favorito_controller extends Controller
{
    
    function mostrar($pk_usuario){
        $datos_libro=Libro::select("libro.titulo","libro.descripcion","libro.año_publicacion")
        ->join('favorito', 'libro.pk_libro', '=', 'favorito.fk_libro')
        ->where('favorito.fk_usuario', $pk_usuario)
        ->get();
        return view("favoritos", compact("datos_libro"));
    }
}
