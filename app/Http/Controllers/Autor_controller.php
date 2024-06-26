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

    // Método para mostrar el formulario de edición con los datos del autor
    public function mostrarFormularioEdicion($pkAutor)
    {
        $datosAutor = Autor::findOrFail($pkAutor);
        return view('editarAutor', compact('datosAutor'));
    }

    // Método para actualizar los datos del autor
    public function actualizar(Request $req, $pkAutor)
    {
        $datosAutor = Autor::findOrFail($pkAutor);

        $req->validate([
            'nombre_autor' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
        ], [
            'nombre_autor.required' => 'El nombre del autor es obligatorio.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, números y espacios.',
            'nombre_autor.max' => 'El nombre del autor no puede tener más de :max caracteres.',
        ]);

        $datosAutor->nombre_autor = $req->nombre_autor;
        $datosAutor->save();

        if ($datosAutor->pk_autor) {
            return redirect('/autores')->with('success', 'Autor actualizado correctamente.');
        } else {
            return redirect('/autores')->with('error', 'Hubo un problema al actualizar el autor.');
        }
    }

}
