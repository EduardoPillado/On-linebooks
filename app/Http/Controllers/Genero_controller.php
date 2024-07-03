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
            return redirect()->route('genero.mostrar')->with('success', 'Registro exitoso');
        } else {
            return back()->with('error', 'Hubo algún problema con la información');
        }
    }

    public function mostrarGenero()
    {
        $datos_genero = Genero::all();
        return view('tabla_generos', compact('datos_genero'));
    }

    public function mostrarFormularioEdicion($pkGenero)
    {
        $datosGenero = Genero::findOrFail($pkGenero);
        return view('editar_genero', compact('datosGenero'));
    }

    public function actualizar(Request $req, $pkGenero)
    {
        $datosGenero = Genero::findOrFail($pkGenero);

        $req->validate([
            'nombre_genero' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
        ], [
            'nombre_genero.required' => 'El nombre del género es obligatorio.',
            'nombre_genero.regex' => 'El nombre del género solo puede contener letras, números y espacios.',
            'nombre_genero.max' => 'El nombre del género no puede tener más de :max caracteres.',
        ]);

        $datosGenero->nombre_genero = $req->nombre_genero;
        $datosGenero->save();

        if ($datosGenero->pk_genero) {
            return redirect()->route('genero.mostrar')->with('success', 'Género actualizado correctamente.');
        } else {
            return redirect()->route('genero.mostrar')->with('error', 'Hubo un problema al actualizar el género.');
        }
    }

    public function eliminar($pkGenero)
    {
        $genero = Genero::findOrFail($pkGenero);
        $genero->delete();

        return redirect()->route('genero.mostrar')->with('success', 'Género eliminado correctamente.');
    }
}
