<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Usuarios dados de baja</title>
</head>
<body>

@include('sidebar')

<div class="my-table-container">
    <table class="my-responsive-table">
        <thead>
            <tr>
                <th class="my-table-header">Nombre de usuario</th>
                <th class="my-table-header">Correo</th>
                <th class="my-table-header">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">
                    <div class="button-container">
                        <a class="button2 btn-primary btn-sm" href="{{ route('usuario.mostrarUsuarios') }}">
                            Volver a Usuarios Activos
                        </a>
                    </div>
                </td>
            </tr>
            @isset($datos_usuario)
                @foreach ($datos_usuario as $usuario)
                    <tr>
                        <td class="my-table-cell">{{ $usuario->nombre_usuario }}</td>
                        <td class="my-table-cell">{{ $usuario->correo }}</td>
                        <td class="my-table-cell">
                            <div class="button-container">
                                <form action="{{ route('usuario.darDeAlta', $usuario->pk_usuario) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="button2 btn-success btn-sm">Dar de alta</button>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>

@include('fooder')

</body>
</html>
