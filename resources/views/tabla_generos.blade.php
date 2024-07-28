<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Géneros registrados</title>
</head>
<body>

    @include('sidebar')

<div class="my-table-container">
    <table class="my-responsive-table">
        <thead>
            <tr>
                <th class="my-table-header">Nombre de género</th>
                <th class="my-table-header">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <div class="button-container">
                        <a class="button2 btn-danger btn-sm" href="{{ route('genero.dadosDeBaja') }}">
                            Géneros dados de baja
                        </a>
                        <a class="button2 btn-danger btn-sm" href="{{ route('form_generos') }}">
                            Crear nuevo género
                        </a>
                    </div>
                </td>
            </tr>
            @isset($datos_genero)
                @foreach ($datos_genero as $genero)
                    <tr>
                        <td class="my-table-cell">{{ $genero->nombre_genero }}</td>
                        <td class="my-table-cell">
                            <div class="button-container">
                                <form action="{{ route('genero.mostrarFormularioEdicion', $genero->pk_genero) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="button2 btn-danger btn-sm">Editar</button>
                                </form>
                                <div class="d-inline">
                                    <a class="button2 btn-danger btn-sm" href="{{ route('genero.baja', $genero->pk_genero) }}" onclick="confirmarBaja(event)">
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
                text: '¿Deseas dar de baja este género?',
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
