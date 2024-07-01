<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genero;

class Genero_controller extends Controller
{
    // función para mostrar categoria por categoria, seleccionando el nombre de la bd
    function mostrar(){
        $datos_genero=Genero::select('genero.nombre_genero')->get();
        return view("categorias", compact("datos_genero"));
    }
}
