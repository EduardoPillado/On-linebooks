<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <style>

        .libro {
            width: 35%;
            background-color: #fff; /* Fondo de cada libro */
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Sombra suave */
        }

        .libro .informacion_libro {
            background-color: #007bff; /* Color de fondo del encabezado */
            color: #fff; /* Color de texto del encabezado */
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            margin-bottom: 10px;
        }

        .libro img {
            max-width: 80%;
            max-height: 300px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .libro h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .libro p {
            font-size: 0.9em; /* Tamaño de fuente más pequeño */
            margin-bottom: 8px;
        }

        .libro .acciones {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .libro .acciones a {
            text-decoration: none;
            font-size: 1.2em;
            color: #007bff; /* Color del enlace */
        }

        .libro .acciones a:hover {
            color: #0056b3; /* Color del enlace al pasar el ratón */
        }
    </style>
</head>
<body>

    @include('sidebar')

    @php
        $tipo_usuario = session('nombre_tipo_usuario');
    @endphp

    @foreach ( $datos_libro as $dato )
        <div class="libro">
            <div class="informacion_libro">
                <h3>{{ $dato->titulo }}</h3>
            </div>

            <div>
                <img src="{{ asset('storage/' .$dato->imagen_portada) }}" alt="Portada del libro {{ $dato->titulo }}">
                <p>{{ $dato->descripcion }}</p>
                <p>Año de publicación: {{ $dato->año_publicacion }}</p>
                <p>
                    @if($dato->autores->count() === 1)
                        Autor:
                    @else
                        Autores:
                    @endif
                    @foreach($dato->autores as $autor)
                        {{ $loop->first ? '' : ', ' }}{{ $autor->nombre_autor }}
                    @endforeach
                </p>
                <p>
                    @if($dato->generos->count() === 1)
                        Género:
                    @else
                        Géneros:
                    @endif
                    @foreach($dato->generos as $genero)
                        {{ $loop->first ? '' : ', ' }}{{ $genero->nombre_genero }}
                    @endforeach
                </p>
                <a href="{{ route('libro.leer', $dato->pk_libro) }}" target="_blank">
                    Leer
                </a>
                <a href="{{ route('libro.descargar', $dato->pk_libro) }}">
                    Descargar
                </a>
            </div>
            @if($tipo_usuario == 'Administrador')
                <div class="acciones">
                    <div>
                        <a href="{{ route('libro.mostrar_por_id', $dato->pk_libro) }}">
                            <i class="bi bi-pencil-square" title="Editar datos"></i> Editar
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('libro.baja', $dato->pk_libro) }}" onclick="confirmarBaja(event)">
                            <i class="bi bi-lock" title="Dar de baja"></i> Dar de baja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    <script>
        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Deseas dar de baja este libro?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link.href;
                    }
                });
            }
        }
    </script>

    @include('fooder')
