<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Inicio</title>
</head>
<body>
    @include('sidebar')

    @php
        $tipo_usuario = session('nombre_tipo_usuario');
    @endphp

<div class="card-container">
    @foreach ($datos_libro as $dato)
<article class="card">
    <img
      class="card__background"
      src="{{ asset('storage/' . $dato->imagen_portada) }}"
      alt="Portada del libro {{ $dato->titulo }}"
      width="2000"
      height="2300"
    />
    <div class="card__content | flow">
      <div class="card__content--container | flow">
        <h2 class="card__title">{{ $dato->titulo }}</h2>
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
      </div>
      <div class="card__button-container">
        <a href="{{ route('libro.leer', $dato->pk_libro) }}" target="_blank" class="card__button card__button__style">Leer</a>
        <a href="{{ route('libro.descargar', $dato->pk_libro) }}" class="card__button card__button__style">Descargar</a>
      </div>
      @if($tipo_usuario == 'Administrador')
    <div class="card__button-container">
        <div>
            <a class="card__button card__button__style__admin" href="{{ route('libro.mostrar_por_id', $dato->pk_libro) }}">
                Editar
            </a>
        </div>
        <div>
            <a class="card__button card__button__style__admin" href="{{ route('libro.baja', $dato->pk_libro) }}" onclick="confirmarBaja(event)">
                Dar de baja
            </a>
        </div>
    </div>
    @endif
    </div>
</article>
@endforeach
</div>



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
