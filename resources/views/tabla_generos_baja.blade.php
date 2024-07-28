<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Géneros dados de baja</title>
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
                        <a class="button2 btn-primary btn-sm" href="{{ route('genero.mostrar') }}">
                            Volver
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
                                <form action="{{ route('genero.darDeAlta', $genero->pk_genero) }}" method="POST" style="display:inline;">
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
