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
            @isset($datos_genero)
                @foreach ($datos_genero as $genero)
                    <tr>
                        <td class="my-table-cell">{{ $genero->nombre_genero }}</td>
                        <td class="my-table-cell">
                            <div class="button-container">
                                <form action="{{ route('genero.mostrarFormularioEdicion', $genero->pk_genero) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="button2 btn-danger btn-sm">Editar</button>
                                </form>
                                <form action="{{ route('genero.eliminar', $genero->pk_genero) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button2 btn-danger btn-sm">Eliminar</button>
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
