@include('sidebar')

<div class="form-container">
    <p class="title">Editar Genero</p>
    <form class="form" id="form-register" action="{{ route('genero.actualizar', $datosGenero->pk_genero   ) }}" method="post">
        @csrf
        @method('PUT') {{-- Usamos PUT para enviar una solicitud PUT --}}
        <div class="input-group">
            <label for="nombre_genero">Nombre de género</label>
            <input type="text" name="nombre_genero" id="nombre_genero" value="{{ $datosGenero->nombre_genero }}" placeholder="Ingresa el nuevo género">
        </div>
        <button type="submit" class="sign">Actualizar</button>
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
