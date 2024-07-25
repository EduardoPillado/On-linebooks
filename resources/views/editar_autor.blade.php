<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Editar autor</title>
</head>
<body>

    @include('sidebar')

<div class="form-container">
    <p class="title">Editar Autor</p>
    <form class="form" id="form-update" action="{{ route('autor.actualizar', $datosAutor->pk_autor) }}" method="post">
        @csrf
        @method('PUT') {{-- Usamos PUT para enviar una solicitud PUT --}}
        <div class="input-group">
            <label for="nombre_autor">Nombre del autor</label>
            <input type="text" name="nombre_autor" id="nombre_autor" value="{{ $datosAutor->nombre_autor }}" placeholder="Ingresa el nuevo nombre del autor">
        </div>
        <button type="submit" class="sign">Actualizar</button>
    </form>
    
</div>

@include('fooder')

<script>
    document.getElementById('form-update').addEventListener('submit', function(event) {
        var nombreAutor = document.getElementById('nombre_autor').value;

        if (!nombreAutor) {
            event.preventDefault();
            showErrorToast('El nombre del autor es requerido.');
        }
    });

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
    
</body>
</html>