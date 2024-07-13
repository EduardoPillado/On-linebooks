@include('sidebar')

<div class="form-container">
    <p class="title">Editar Perfil</p>
    <form class="form" id="form-edit-profile" action="{{ route('usuario.actualizar', ['pkUsuario' => $datosUsuario->pk_usuario]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="input-group">
            <label for="username">Nombre de usuario</label>
            <input autocomplete="off" type="text" name="nombre_usuario" id="username" value="{{ old('nombre_usuario', $datosUsuario->nombre_usuario) }}" placeholder="Ingresa tu nombre de usuario">
        </div>
        <div class="input-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo', $datosUsuario->correo) }}" placeholder="Ingresa tu correo electrónico" required>
        </div>
        <button class="sign">Guardar Cambios</button>

        @if($errors->any())
        @foreach($errors->all() as $error)
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
                showErrorToast('{{ $error }}');
            </script>
        @endforeach
        @endif
    </form>
</div>

@include('fooder')
