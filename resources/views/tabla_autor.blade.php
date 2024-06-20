@include('sidebar')

<div class="my-table-container">
    <table class="my-responsive-table">
        <thead>
            <tr>
                <th class="my-table-header">ID</th>
                <th class="my-table-header">Nombre del autor</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($generos as $genero)
                <tr>
                    <td class="my-table-cell">{{ $genero->pk_genero }}</td>
                    <td class="my-table-cell">{{ $genero->nombre_genero }}</td> 
                </tr>
            @endforeach --}}
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>



@include('fooder')

