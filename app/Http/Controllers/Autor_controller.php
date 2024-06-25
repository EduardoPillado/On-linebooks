<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class Autor_controller extends Controller
{
    public function insertar(Request $req)
    {
        $req->validate([
            'nombre_autor' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
        ], [
            'nombre_autor.required' => 'El nombre del género es obligatorio.',
            'nombre_autor.regex' => 'El nombre del género solo puede contener letras, números y espacios.',
            'nombre_autor.max' => 'El nombre del género no puede tener más de :max caracteres.',
        ]);

        $autor = new Autor();
        $autor->nombre_autor = $req->nombre_autor;
        $autor->save();
        
        if ($autor->pk_autor) {
            return redirect('/')->with('success', 'Registro exitoso');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    function mostrarAutor(){
        $datos_autor=Autor::all();
        return view('tabla_autor',compact('datos_autor'));
    }
}
