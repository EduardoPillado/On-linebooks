@include('sidebar')

<style>
   
</style>

<div class="my-table-container">
    <table class="my-responsive-table">
        <thead>
            <tr>
                <th class="my-table-header">ID</th>
                <th class="my-table-header">Nombre del autor</th>
                <th class="my-table-header">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos_autor as $autor)
                <tr>
                    <td class="my-table-cell">{{ $autor->pk_autor }}</td>
                    <td class="my-table-cell">{{ $autor->nombre_autor }}</td>
                    <td class="my-table-cell">
                        <div class="button-container">
                            <form action="route('autor.editar', $autor->pk_autor)" method="GET" style="display:inline;">
                                <button type="submit" class="button2 btn-danger btn-sm">Editar</button>
                            </form>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button2 btn-danger btn-sm">Dar de baja</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ route('autor.eliminar', $autor->pk_autor) }} --}}
@include('fooder')

