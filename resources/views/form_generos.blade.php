<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Agregar género</title>
</head>
<body>
    
    @include('sidebar')

<div class="form-container">
    <p class="title">Géneros</p>
    <form class="form" id="form-register" action="{{ route('genero.insertar') }}" method="post">
        @csrf
        <div class="input-group">
            <label for="nombre_genero">Nombre de género</label>
            <input type="text" name="nombre_genero" id="nombre_genero" placeholder="Ingresa el nuevo género">
        </div>
        <button type="submit" class="sign">Registrar</button>
    </form>
</div>

@include('fooder')

<script>
    document.getElementById('form-register').addEventListener('submit', function(event) {
        var nombreGenero = document.getElementById('nombre_genero').value;

        if (!nombreGenero) {
            event.preventDefault();
            showErrorToast('El nombre del género es requerido.');
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



  @include('fooder')

</body>
</html>