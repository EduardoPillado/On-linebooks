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
            'nombre_autor.required' => 'El nombre del autor es obligatorio.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, números y espacios.',
            'nombre_autor.max' => 'El nombre del autor no puede tener más de :max caracteres.',
        ]);

        $autor = new Autor();
        $autor->nombre_autor = $req->nombre_autor;
        $autor->save();
        
        return redirect()->route('autor.mostrar')->with('success', 'Registro exitoso');
    }

    public function mostrarAutor()
    {
        $datos_autor = Autor::all();
        return view('tabla_autor', compact('datos_autor'));
    }

    public function mostrarFormularioEdicion($pkAutor)
    {
        $datosAutor = Autor::findOrFail($pkAutor);
        return view('editar_autor', compact('datosAutor'));
    }

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

        return redirect()->route('autor.mostrar')->with('success', 'Autor actualizado correctamente.');
    }

    public function eliminar($pkAutor)
    {
        $autor = Autor::findOrFail($pkAutor);
        $autor->delete();

        return redirect()->route('autor.mostrar')->with('success', 'Autor eliminado correctamente.');
    }
}
