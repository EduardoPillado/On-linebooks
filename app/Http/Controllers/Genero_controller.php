<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genero;

class Genero_controller extends Controller
{
    // función para mostrar categoria por categoria, seleccionando el nombre de la bd
    function mostrar(){
        $datos_genero=Genero::select('genero.nombre_genero')
        ->where('estatus_genero', 1)
        ->get();
        return view("categorias", compact("datos_genero"));
    }
    
    public function insertar(Request $req)
    {
        $req->validate([
            'nombre_genero' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:genero,nombre_genero'],
        ], [
            'nombre_genero.required' => 'El nombre del género es obligatorio.',
            'nombre_genero.regex' => 'El nombre del género solo puede contener letras, números y espacios.',
            'nombre_genero.max' => 'El nombre del género no puede tener más de :max caracteres.',
            'nombre_genero.unique' => 'El nombre del género ya existe.',
        ]);

        $genero = new Genero();
        $genero->nombre_genero = $req->nombre_genero;
        $genero->estatus_genero = 1;
        $genero->save();
        
        if ($genero->pk_genero) {
            return redirect()->route('genero.mostrar')->with('success', 'Registro exitoso');
        } else {
            return back()->with('error', 'Hubo algún problema con la información');
        }
    }

    public function mostrarGenero()
    {
        $datos_genero = Genero::where('estatus_genero', '=', 1)->get();
        return view('tabla_generos', compact('datos_genero'));
    }

    public function mostrarFormularioEdicion($pkGenero)
    {
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $datosGenero = Genero::findOrFail($pkGenero);
                return view('editar_genero', compact('datosGenero'));
            } else {
                return redirect()->back()->with('warning', 'No puedes acceder');
            }
        } else {
            return redirect()->back()->with('warning', 'No puedes acceder');
        }
    }

    public function actualizar(Request $req, $pkGenero)
    {
        $datosGenero = Genero::findOrFail($pkGenero);

        $req->validate([
            'nombre_genero' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:genero,nombre_genero'],
        ], [
            'nombre_genero.required' => 'El nombre del género es obligatorio.',
            'nombre_genero.regex' => 'El nombre del género solo puede contener letras, números y espacios.',
            'nombre_genero.max' => 'El nombre del género no puede tener más de :max caracteres.',
            'nombre_genero.unique' => 'El nombre del género ya existe.',
        ]);

        $datosGenero->nombre_genero = $req->nombre_genero;
        $datosGenero->estatus_genero = 1;
        $datosGenero->save();

        if ($datosGenero->pk_genero) {
            return redirect()->route('genero.mostrar')->with('success', 'Género actualizado correctamente.');
        } else {
            return redirect()->route('genero.mostrar')->with('error', 'Hubo un problema al actualizar el género.');
        }
    }

    public function baja($pk_genero){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $dato = Genero::findOrFail($pk_genero);

                if ($dato) {
                    $dato->estatus_genero = 0;
                    $dato->save();

                    return back()->with('success', 'Género dado de baja');
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

    public function mostrarGenerosDadosDeBaja()
{
    $datos_genero = Genero::where('estatus_genero', '=', 0)->get();
    return view('tabla_generos_baja', compact('datos_genero'));
}

public function darDeAlta($pk_genero, Request $request)
{
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        $tipo_usuario = session('nombre_tipo_usuario');
        if ($tipo_usuario == 'Administrador') {
            $dato = Genero::findOrFail($pk_genero);

            if ($dato) {
                $dato->estatus_genero = 1;
                $dato->save();

                return redirect()->route('genero.dadosDeBaja')->with('success', 'Género dado de alta');
            } else {
                return redirect()->route('genero.dadosDeBaja')->with('error', 'Hay algún problema con la información');
            }
        } else {
            return redirect('/')->with('warning', 'No puedes acceder');
        }
    } else {
        return redirect('/login');
    }
}





    // public function eliminar($pkGenero)
    // {
    //     $genero = Genero::findOrFail($pkGenero);
    //     $genero->delete();

    //     return redirect()->route('genero.mostrar')->with('success', 'Género eliminado correctamente.');
    // }
}
