@include('sidebar')

<div class="form-container">
    <p class="title">Autor</p>
    <form class="form" id="form-register" action="{{ route('autor.insertar') }}" method="post">
        @csrf
        <div class="input-group">
            <label for="nombre_genero">Nombre del autor</label>
            <input type="text" name="nombre_autor" id="nombre_autor" placeholder="Ingresa el nuevo autor">
        </div>
        <button type="submit" class="sign">Registrar</button>
    </form>
</div>

@include('fooder')

<script>
    document.getElementById('form-register').addEventListener('submit', function(event) {
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
