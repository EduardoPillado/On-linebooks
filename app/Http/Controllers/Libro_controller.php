<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;

class Libro_controller extends Controller
{
    public function libro_opciones(){
        $autores = Autor::all();
        $generos = Genero::all();
        return view('form_libro', compact('autores', 'generos'));
    }

    public function insertar(Request $req) {
        $req->validate([
            'titulo' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
            'descripcion' => ['required', 'max:1000'],
            'autores' => ['required', 'array'],
            'autores.*' => ['exists:autores,pk_autor'],
            'año_publicacion' => ['required', 'digits:4', 'integer', 'min:1000', 'max:' . date('Y')],
            'imagen_portada' => ['nullable', 'image'],
            'pdf_ruta' => ['required', 'mimes:pdf'],
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.regex' => 'El título solo puede contener letras, números y espacios.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.',

            'autores.required' => 'Debe seleccionar al menos un autor.',
            'autores.*.exists' => 'El autor seleccionado no es válido.',
            
            'año_publicacion.required' => 'El año de publicación es obligatorio.',
            'año_publicacion.digits' => 'El año de publicación debe tener 4 dígitos.',
            'año_publicacion.integer' => 'El año de publicación debe ser un número entero.',
            'año_publicacion.min' => 'El año de publicación debe ser un año válido.',
            'año_publicacion.max' => 'El año de publicación no puede ser mayor al año actual.',
            
            'imagen_portada.image' => 'La portada debe ser una imagen válida.',
            
            'pdf_ruta.required' => 'El PDF del libro es obligatorio.',
            'pdf_ruta.mimes' => 'El libro debe ser un archivo con formato PDF.',
        ]);
    
        $libro = new Libro();
        
        if ($req->hasFile('pdf_ruta')) {
            $libro->titulo = $req->titulo;
            $libro->descripcion = $req->descripcion;
            $libro->año_publicacion = $req->año_publicacion;
            if ($req->hasFile('imagen_portada')) {
                $imagen = $req->file('imagen_portada');
                $path = $imagen->store('portadas', 'public');
                $libro->imagen_portada = $path;
            }
            $pdf = $req->file('pdf_ruta');
            $path = $pdf->store('libros', 'public');
            $libro->pdf_ruta = $path;
            $libro->estatus_libro = 1;
    
            $libro->save();
    
            $libro->autores()->attach($req->autores);
            $libro->generos()->attach($req->generos);
            
            return redirect('/')->with('success', 'Libro agregado');
        } else {
            return back()->with('warning', 'Debe agregar el PDF del libro.');
        }
    }

    public function mostrar(){
        $PKUSUARIO = session('pk_usuario');
        if ($PKUSUARIO) {
            $tipo_usuario = session('tipo_usuario');
            if ($tipo_usuario == 1) {
                $datos_libro=Libro::where('estatus_libro', '=', 1)->get();
                return view('tabla_libros', compact('datos_libro'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
