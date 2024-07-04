@include('sidebar')

<div class="my-table-container">
    <table class="my-responsive-table">
        <thead>
            <tr>
                <th class="my-table-header">Nombre del autor</th>
                <th class="my-table-header">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @isset($datos_autor)
                @foreach ($datos_autor as $autor)
                    <tr>
                        <td class="my-table-cell">{{ $autor->nombre_autor }}</td>
                        <td class="my-table-cell">
                            <div class="button-container">
                                <form action="{{ route('autor.mostrarFormularioEdicion', $autor->pk_autor) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="button2 btn-danger btn-sm">Editar</button>
                                </form>
                                <div class="d-inline">
                                    <a class="button2 btn-danger btn-sm" href="{{ route('autor.baja', $autor->pk_autor) }}" onclick="confirmarBaja(event)">
                                        Dar de baja
                                    </a> 
                                </div>
                                {{-- <form action="{{ route('autor.baja', $autor->pk_autor) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="button2 btn-danger btn-sm">Dar de baja</button>
                                </form> --}}
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
