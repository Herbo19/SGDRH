<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descrição</th>
            <th>Eliminar</th>
            <th>Atualizar</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descrição</th>
            <th>Eliminar</th>
            <th>Atualizar</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td><input type="checkbox" name="" id=""></td>
                <td>{{ $role->id }}</td>
                <td>{{ $role->titulo }}</td>
                <td>{{ $role->descricao }}</td>
                <td>
                    <a onclick="return confirm('Pretende eliminar estes dados?')" href=""
                    class="btn btn-danger btn-sm">Eliminar</a>
                </td>
                <td>
                    <a href="" class="btn btn-primary btn-sm">Atualizar</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

