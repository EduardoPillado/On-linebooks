<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class Autor_controller extends Controller
{
    public function insertar(Request $req)
    {
        $req->validate([
            'nombre_autor' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:autor,nombre_autor'],
        ], [
            'nombre_autor.required' => 'El nombre del autor es obligatorio.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, números y espacios.',
            'nombre_autor.max' => 'El nombre del autor no puede tener más de :max caracteres.',
            'nombre_autor.unique' => 'El nombre del autor ya existe.',
        ]);

        $autor = new Autor();
        $autor->nombre_autor = $req->nombre_autor;
        $autor->estatus_autor = 1;
        $autor->save();
        
        return redirect()->route('autor.mostrar')->with('success', 'Registro exitoso');
    }

    public function mostrarAutor()
    {
        $datos_autor = Autor::where('estatus_autor', '=', 1)->get();
        return view('tabla_autor', compact('datos_autor'));
    }

    public function mostrarFormularioEdicion($pkAutor)
    {
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $datosAutor = Autor::findOrFail($pkAutor);
                return view('editar_autor', compact('datosAutor'));
            } else {
                return redirect()->back()->with('warning', 'No puedes acceder');
            }
        } else {
            return redirect()->back()->with('warning', 'No puedes acceder');
        }
    }

    public function actualizar(Request $req, $pkAutor)
    {
        $datosAutor = Autor::findOrFail($pkAutor);

        $req->validate([
            'nombre_autor' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:autor,nombre_autor'],
        ], [
            'nombre_autor.required' => 'El nombre del autor es obligatorio.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, números y espacios.',
            'nombre_autor.max' => 'El nombre del autor no puede tener más de :max caracteres.',
            'nombre_autor.unique' => 'El nombre del autor ya existe.',
        ]);

        $datosAutor->nombre_autor = $req->nombre_autor;
        $datosAutor->estatus_autor = 1;
        $datosAutor->save();

        return redirect()->route('autor.mostrar')->with('success', 'Autor actualizado correctamente.');
    }

    public function baja($pk_autor){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $dato = Autor::findOrFail($pk_autor);

                if ($dato) {
                    $dato->estatus_autor = 0;
                    $dato->save();

                    return back()->with('success', 'Autor dado de baja');
                } else {
                    return back()->with('error', 'Hay algún problema con la información');
                }
            } else {
                return redirect('/')->with('warning', 'No puedes acceder');
            }
        } else {
            return redirect('/login');
        }
    }
}
