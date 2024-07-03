<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;

class Libro_controller extends Controller
{
    function mostrar_por_categoria($categoria){
        // Buscar el ID del género por su nombre
        $genero = Genero::where('nombre_genero', $categoria)->first();
    
        if (!$genero) {
            abort(404); // Manejo de error si la categoría no existe
        }
    
        // Obtener los libros que pertenecen al género encontrado
        $datos_libro = $genero->libros()
                              ->select("libro.titulo", "libro.descripcion", "libro.año_publicacion")
                              ->get();
    
        return view("libro_cat", compact("datos_libro"));
    }

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
                $imagenNombre = $imagen->getClientOriginalName();
                $path = $imagen->storeAs('portadas', $imagenNombre, 'public');
                $libro->imagen_portada = 'portadas/' . $imagenNombre;
            }
            $pdf = $req->file('pdf_ruta');
            $pdfNombre = $pdf->getClientOriginalName();
            $path = $pdf->storeAs('libros', $pdfNombre, 'public');
            $libro->pdf_ruta = 'libros/' . $pdfNombre;
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
        $datos_libro=Libro::where('estatus_libro', '=', 1)->get();
        return view('inicio', compact('datos_libro'));
    }

    public function baja($pk_libro){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
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

    public function leer($pk_libro){
        $libro = Libro::findOrFail($pk_libro);
        $ruta = storage_path('app/public/' . $libro->pdf_ruta);

        if (!file_exists($ruta)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file($ruta);
    }

    public function descargar($pk_libro){
        $libro = Libro::findOrFail($pk_libro);
        $ruta = storage_path('app/public/' . $libro->pdf_ruta);

        if (!file_exists($ruta)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->download($ruta);
    }

    public function mostrar_por_id($pk_libro){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $datos_libro = Libro::with('autores', 'generos')->findOrFail($pk_libro);
                $autores = Autor::all();
                $generos = Genero::all();
              
                return view('editar_libro', compact('datos_libro', 'autores', 'generos'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function actualizar(Request $req, $pk_libro) {
        $datos_libro = Libro::findOrFail($pk_libro);
        
        $datos_libro->titulo = $req->titulo;
        $datos_libro->descripcion = $req->descripcion;
        $datos_libro->año_publicacion = $req->año_publicacion;
        if ($req->hasFile('imagen_portada')) {
            $imagen = $req->file('imagen_portada');
            $imagenNombre = $imagen->getClientOriginalName();
            $path = $imagen->storeAs('portadas', $imagenNombre, 'public');
            $datos_libro->imagen_portada = 'portadas/' . $imagenNombre;
        }
        if ($req->hasFile('pdf_ruta')) {
            $pdf = $req->file('pdf_ruta');
            $pdfNombre = $pdf->getClientOriginalName();
            $path = $pdf->storeAs('libros', $pdfNombre, 'public');
            $datos_libro->pdf_ruta = 'libros/' . $pdfNombre;
        }
        $datos_libro->estatus_libro = 1;
        $autoresSeleccionados = $req->input('autores', []);
        $generosSeleccionados = $req->input('generos', []);
    
        $datos_libro->save();
    
        $datos_libro->autores()->sync($autoresSeleccionados);
        $datos_libro->generos()->sync($generosSeleccionados);
            
        return back()->with('success', 'Libro actualizado');
    }
}
