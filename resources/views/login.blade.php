<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
  <title>On-linebooks | Inicio de sesión</title>
</head>
<body>

  @include('sidebar')
    
  <div class="form-container">
      <p class="title">Inicio de sesión</p>
      <form class="form" id="form-register" action="{{ route('usuario.login') }}" method="post">
          @csrf
          <div class="input-group">
          <label for="username">Nombre de usuario</label>
          <input autocomplete="off" type="text" name="nombre_usuario" id="username" placeholder="Ingresa tu nombre de usuario">
        </div>
        <div class="input-group">
          <label for="password">Contraseña</label>
          <input type="password" name="contraseña" id="contraseña" placeholder="Ingresa tu contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener un número, una mayúscula, una minúlcula, y ser 8 caracteres" required>
        </div>
        <button class="sign">Iniciar sesión</button>

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
    
    <script>
        document.getElementById('form-register').addEventListener('submit', function(event) {
            var correo = document.getElementById('correo').value;
            var confirmar_correo = document.getElementById('conf_correo').value;
            var contraseña = document.getElementById('contraseña').value;
            var confirmar_contraseña = document.getElementById('conf_contraseña').value;
    
            if (correo !== confirmar_correo) {
                Swal.fire({
                    title: 'Los correos no coinciden.',
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
                event.preventDefault();
            }

            if (contraseña !== confirmar_contraseña) {
                Swal.fire({
                    title: 'Las contraseñas no coinciden.',
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
                event.preventDefault();
            }
        });
    </script>

      </form>
      <p class="signup">¿Aun no tienes una cuenta con nosotros?, <a href="{{ route('registro') }}">Registrate aquí</a>.</p>
    </div>

    @include('fooder')

</body>
</html>