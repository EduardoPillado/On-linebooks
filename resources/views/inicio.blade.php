<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
</head>
<body>

    @include('sidebar')

    @php
        $tipo_usuario = session('tipo_usuario');
    @endphp

    @foreach ( $datos_libro as $dato )
        <div>
            <div>
                <img src="{{ asset('storage/' .$dato->imagen_portada) }}" width="200px" height="300px">
                <h3>{{ $dato->titulo }}</h3>
            </div>
            
            <div>
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
                {{-- <a href="{{ route('libro.leer') }}">
                    Leer
                </a>
                <a href="{{ route('libro.descargar') }}">
                    Descargar
                </a> --}}
            </div>
            
            {{-- @if($tipo_usuario == 'Administrador')
                <div>
                    <div>
                        <a href="{{ route('libro.mostrar_por_id', $dato->pk_libro) }}">
                            <i class="bi bi-pencil-square" title="Editar datos"></i>
                        </a>
                    </div>
                    
                    <div>
                        <a href="{{ route('libro.baja', $dato->pk_libro) }}" onclick="confirmarBaja(event)">
                            <i class="bi bi-lock" title="Dar de baja"></i>
                        </a>
                    </div>
                </div>
            @endif --}}
        </div>
    @endforeach

    {{-- <script>
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
    </script> --}}
    
</body>
</html>