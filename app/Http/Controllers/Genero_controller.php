<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class Genero_controller extends Controller
{
    public function insertar(Request $req)
    {
        $req->validate([
            'nombre_genero' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
        ], [
            'nombre_genero.required' => 'El nombre del género es obligatorio.',
            'nombre_genero.regex' => 'El nombre del género solo puede contener letras, números y espacios.',
            'nombre_genero.max' => 'El nombre del género no puede tener más de :max caracteres.',
        ]);

        $genero = new Genero();
        $genero->nombre_genero = $req->nombre_genero;
        $genero->save();
        
        if ($genero->pk_genero) {
            return redirect('/')->with('success', 'Registro exitoso');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    // public function mostrarGeneros()
    // {
    //     // Suponiendo que estamos usando autenticación para obtener el usuario
    //     $PKUSUARIO = session('pkUsuario');

    //     if ($PKUSUARIO) {
    //         // Obtener todos los géneros
    //         $generos = Genero::all();

    //         // Comprobar si existen géneros
    //         if ($generos->isEmpty()) {
    //             return redirect()->back()->with('warning', 'No hay géneros registrados');
    //         } else {
    //             // Pasar los datos a la vista
    //             return view('tabla_generos', compact('generos'));
    //         }
    //     } else {
    //         return redirect('/')->with('error', 'Debe estar autenticado para ver los géneros');
    //     }
    // }

    function mostrarGeneros(){
        $datos_genero=Genero::all();
        return view('tabla_generos',compact('datos_genero'));
    }
}
