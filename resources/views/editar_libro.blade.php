<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar libro</title>
</head>
<body>

    @include('sidebar')

    <div class="form-container-large">
        <p class="title">Editar libro</p>
        <form class="form" id="form-register" action="{{ route('libro.actualizar', $datos_libro->pk_libro) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-group">
                <label for="titulo">Título del libro</label>
                <input type="text" name="titulo" id="titulo" value="{{ $datos_libro->titulo }}" placeholder="Ingresa el título del libro">
            </div>
            <div class="input-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="3" placeholder="Ingresa la descripción">{{ $datos_libro->descripcion }}</textarea>
            </div>
            <div class="input-group">
                <label for="año_publicacion">Año de publicación</label>
                <input type="number" name="año_publicacion" id="año_publicacion" value="{{ $datos_libro->año_publicacion }}" placeholder="Ingresa el año de publicación">
            </div>
            <div class="input-group">
                <label>Imagen actual</label>
                <td>
                    <img src="{{ asset('storage/' .$datos_libro->imagen_portada) }}" width="300px" height="400px">
                </td>

                <label for="imagen_portada">Imagen portada</label>
                <input type="file" name="imagen_portada" id="imagen_portada" placeholder="Ingresa la imagen de portada">
            </div>
            <div class="input-group">
                <label>PDF del libro actual</label>
                <td>
                    <iframe src="{{ asset('storage/' . $datos_libro->pdf_ruta) }}" width="80%" height="400px"></iframe>
                </td>

                <label for="pdf_ruta">Ruta del PDF</label>
                <input type="file" name="pdf_ruta" id="pdf_ruta" placeholder="Ingresa el archivo PDF">
            </div>
            <div class="input-group">
            <label for="autores">Autor</label>
            <select name="autores[]" id="autores" multiple>
                @foreach ($autores as $autor)
                    <option @if($datos_libro->autores->contains($autor->pk_autor)) selected @endif value="{{ $autor->pk_autor }}">
                        {{ $autor->nombre_autor }}
                    </option>
                @endforeach
            </select>
            </div>
            <div class="input-group">
                <label for="generos">Genero</label>
                <select name="generos[]" id="generos" multiple>
                @foreach ($generos as $genero)
                    <option @if($datos_libro->generos->contains($genero->pk_genero)) selected @endif value="{{ $genero->pk_genero }}">
                        {{ $genero->nombre_genero }}
                    </option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="sign">Registrar</button>
        </form>
    </div>

    @include('fooder')

    <script>
        function showErrorToast(message) {
            Swal.fire({
                title: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                icon: 'error',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        }
    </script>
