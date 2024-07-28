<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Usuarios registrados</title>
</head>
<body>

    @include('sidebar')

    <div class="my-table-container-large">
        <table class="my-responsive-table">
            <thead>
                <tr>
                    <th class="my-table-header">Nombre de usuario</th>
                    <th class="my-table-header">Correo</th>
                    <th class="my-table-header">Acceso del usuario</th>
                    <th class="my-table-header">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">
                        <div class="button-container">
                            <a class="button2 btn-warning btn-sm" href="{{ route('usuario.dadosDeBaja') }}">
                                Usuarios dados de baja
                            </a>
                            <a class="button2 btn-warning btn-sm" href="{{ route('usuario.insertar') }}">
                                Crear nuevo usuario
                            </a>
                        </div>
                    </td>
                </tr>     
                @isset($datos_usuario)
                    @foreach ($datos_usuario as $usuario)
                        <tr>
                            <td class="my-table-cell">{{ $usuario->nombre_usuario }}</td>
                            <td class="my-table-cell">{{ $usuario->correo }}</td>
                            <td class="my-table-cell">{{ $usuario->tipo_usuario->nombre_tipo_usuario }}</td>
                            <td class="my-table-cell">
                                <div class="button-container">
                                    <form action="{{ route('usuario.mostrarFormularioEdicion', $usuario->pk_usuario) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="button2 btn-danger btn-sm">Editar</button>
                                    </form>
                                    <div class="d-inline">
                                        <a class="button2 btn-danger btn-sm" href="{{ route('usuario.baja', $usuario->pk_usuario) }}" onclick="confirmarBaja(event)">
                                            Dar de baja
                                        </a> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>

    <script>
        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Deseas dar de baja este autor?',
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
    
</body>
</html>