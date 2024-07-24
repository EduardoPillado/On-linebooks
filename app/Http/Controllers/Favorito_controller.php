<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favorito;

use App\Models\Libro;

class Favorito_controller extends Controller
{
    public function mostrar($pk_usuario){
        $datos_libro=Libro::select("libro.titulo","libro.descripcion","libro.año_publicacion")
        ->join('favorito', 'libro.pk_libro', '=', 'favorito.fk_libro')
        ->where('favorito.fk_usuario', $pk_usuario)
        ->get();
        return view("favoritos", compact("datos_libro"));
    }

    public function like(Request $request, $pk_libro) {
        // Verificar si el usuario ha iniciado sesión
        if (!session()->has('pk_usuario')) {
            return redirect()->back()->with('warning', 'Inicia sesión para agregar a favoritos');
        }
        // Verificar si el libro existe
        $libro = Libro::find($pk_libro);
        if (!$libro) {
            return redirect()->back()->with('warning', 'Libro no encontrado');
        }
    
        // Verificar si el usuario ya ha dado "Me gusta" al libro
        $favorito = Favorito::where('fk_usuario', session()->get('pk_usuario'))->where('fk_libro', $pk_libro)->first();
        if ($favorito) {
            $pk_usuario = session('pk_usuario');
            if ($pk_usuario) {
                Favorito::where('fk_usuario', $pk_usuario)
                        ->where('fk_libro', $pk_libro)
                        ->delete();
                return redirect()->back()->with('success', 'Libro eliminado de favoritos correctamente.');
            } else {
                return redirect()->back()->with('warning', 'Inicia sesión para eliminar de favoritos.');
            }
        } 
    
        // Crear un nuevo registro de "Me gusta"
        $favorito = new Favorito();
        $favorito->fk_usuario = session()->get('pk_usuario');
        $favorito->fk_libro = $pk_libro;
        $favorito->save();
    
        return redirect()->back()->with('success', 'Has agregado este libro a favoritos');
    }
}