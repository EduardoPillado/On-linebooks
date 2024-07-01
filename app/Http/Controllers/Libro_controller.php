<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Libro;

use App\Models\Genero;

class Libro_controller extends Controller
{
    function mostrar($categoria){
        // Buscar el ID del género por su nombre
        $genero = Genero::where('nombre_genero', $categoria)->first();
    
        if (!$genero) {
            abort(404); // Manejo de error si la categoría no existe
        }
    
        // Obtener los libros que pertenecen al género encontrado
        $datos_libro = $genero->libros()
                              ->select("libro.titulo", "libro.descripcion", "libro.año_publicacion")
                              ->get();
    
        return view("libro_cat", compact("datos_libro"));
    }
}
