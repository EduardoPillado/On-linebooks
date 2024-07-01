@include('sidebar')

<div class="form-container-large">
    <p class="title">Libro</p>
    <form class="form" id="form-register" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <label for="titulo_libro">Título del libro</label>
            <input type="text" name="titulo_libro" id="titulo_libro" placeholder="Ingresa el título del libro">
        </div>
        <div class="input-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="3" placeholder="Ingresa la descripción"></textarea>
        </div>
        <div class="input-group">
            <label for="año_publicacion">Año de publicación</label>
            <input type="date" name="año_publicacion" id="año_publicacion" placeholder="Selecciona el año de publicación">
        </div>
        <div class="input-group">
            <label for="año_publicacion">Año de publicación</label>
            <input type="date" name="año_publicacion" id="año_publicacion" placeholder="Selecciona el año de publicación">
        </div>
        <div class="input-group">
            <label for="imagen_portada">Imagen portada</label>
            <input type="file" name="imagen_portada" id="imagen_portada" placeholder="Selecciona la imagen de portada">
        </div>
        <div class="input-group">
            <label for="ruta_pdf">Ruta del PDF</label>
            <input type="file" name="ruta_pdf" id="ruta_pdf" placeholder="Selecciona el archivo PDF">
        </div>
        <div class="input-group">
            <label for="ruta_pdf">Genero</label>
            <select name="" id="">
                <option value="">-----Selecciona el genero-----</option>
            </select>
        </div>
        <div class="input-group">
            <label for="ruta_pdf">Autor</label>
            <select name="" id="">
                <option value="">-----Selecciona el autor-----</option>
            </select>
        </div>
        <button type="submit" class="sign">Registrar</button>
    </form>
</div>

@include('fooder')

<script>
    document.getElementById('form-register').addEventListener('submit', function(event) {
        var tituloLibro = document.getElementById('titulo_libro').value;
        var descripcion = document.getElementById('descripcion').value;
        var añoPublicacion = document.getElementById('año_publicacion').value;
        var imagenPortada = document.getElementById('imagen_portada').files.length;
        var rutaPdf = document.getElementById('ruta_pdf').files.length;

        if (!tituloLibro) {
            event.preventDefault();
            showErrorToast('El título del libro es requerido.');
        } else if (!descripcion) {
            event.preventDefault();
            showErrorToast('La descripción es requerida.');
        } else if (!añoPublicacion) {
            event.preventDefault();
            showErrorToast('El año de publicación es requerido.');
        } else if (imagenPortada === 0) {
            event.preventDefault();
            showErrorToast('La imagen de portada es requerida.');
        } else if (rutaPdf === 0) {
            event.preventDefault();
            showErrorToast('La ruta del PDF es requerida.');
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
