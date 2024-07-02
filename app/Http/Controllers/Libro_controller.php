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
            'autores.*' => ['exists:autor,pk_autor'],
            'generos' => ['required', 'array'],
            'generos.*' => ['exists:genero,pk_genero'],
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

            'generos.required' => 'Debe seleccionar al menos un género.',
            'generos.*.exists' => 'El género seleccionado no es válido.',
            
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
            $autoresSeleccionados = $req->input('autores', []);
            $generosSeleccionados = $req->input('generos', []);
    
            $libro->save();
    
            $libro->autores()->attach($autoresSeleccionados);
            $libro->generos()->attach($generosSeleccionados);
            
            return back()->with('success', 'Libro agregado');
        } else {
            return back()->with('warning', 'Debe agregar el PDF del libro.');
        }
    }

    public function mostrar(){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $datos_libro=Libro::where('estatus_libro', '=', 1)->get();
            return view('inicio', compact('datos_libro'));
        } else {
            return redirect('/login');
        }
    }

    public function baja($pk_libro){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('fk_tipo_usuario');
            if ($tipo_usuario == 1) {
                $dato = Libro::findOrFail($pk_libro);

                if ($dato) {
                    $dato->estatus_libro = 0;
                    $dato->save();

                    return back()->with('success', 'Libro dada de baja');
                } else {
                    return back()->with('error', 'Hay algún problema con la información');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/login');
        }
    }

    public function mostrar_por_id($pk_libro){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('fk_tipo_usuario');
            if ($tipo_usuario == 1) {
                $datos_libro = Libro::findOrFail($pk_libro);
              
                return view('editar_libro', compact('datos_libro'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function actualizar(Request $req, $pk_libro) {
        $datos_libro = Libro::findOrFail($pk_libro);

        $req->validate([
            'titulo' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255'],
            'descripcion' => ['required', 'max:1000'],
            'autores' => ['required', 'array'],
            'autores.*' => ['exists:autor,pk_autor'],
            'generos' => ['required', 'array'],
            'generos.*' => ['exists:genero,pk_genero'],
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

            'generos.required' => 'Debe seleccionar al menos un género.',
            'generos.*.exists' => 'El género seleccionado no es válido.',
            
            'año_publicacion.required' => 'El año de publicación es obligatorio.',
            'año_publicacion.digits' => 'El año de publicación debe tener 4 dígitos.',
            'año_publicacion.integer' => 'El año de publicación debe ser un número entero.',
            'año_publicacion.min' => 'El año de publicación debe ser un año válido.',
            'año_publicacion.max' => 'El año de publicación no puede ser mayor al año actual.',
            
            'imagen_portada.image' => 'La portada debe ser una imagen válida.',
            
            'pdf_ruta.required' => 'El PDF del libro es obligatorio.',
            'pdf_ruta.mimes' => 'El libro debe ser un archivo con formato PDF.',
        ]);
        
        if ($req->hasFile('pdf_ruta')) {
            $datos_libro->titulo = $req->titulo;
            $datos_libro->descripcion = $req->descripcion;
            $datos_libro->año_publicacion = $req->año_publicacion;
            if ($req->hasFile('imagen_portada')) {
                $imagen = $req->file('imagen_portada');
                $path = $imagen->store('portadas', 'public');
                $datos_libro->imagen_portada = $path;
            }
            $pdf = $req->file('pdf_ruta');
            $path = $pdf->store('libros', 'public');
            $datos_libro->pdf_ruta = $path;
            $datos_libro->estatus_libro = 1;
            $autoresSeleccionados = $req->input('autores', []);
            $generosSeleccionados = $req->input('generos', []);
    
            $datos_libro->save();
    
            $datos_libro->autores()->attach($autoresSeleccionados);
            $datos_libro->generos()->attach($generosSeleccionados);
            
            return back()->with('success', 'Libro actualizado');
        } else {
            return back()->with('warning', 'Debe agregar el PDF del libro.');
        }
    }
}
