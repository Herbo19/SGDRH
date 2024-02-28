@extends('layout')
@section('title','SGDRH - Lista de Metas-Equipas')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de Metas das Equipas</h1>
    <br>
    <br>
    <br>
    @if(Session::has('col'))
        <p class="text-danger">{{session('col')}}</p>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todas Metas</h6>
            <a href="{{ url('metas/equipa/criar') }}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Estado</th>
                            <th>Equipa</th>
                            <th>Data Conclusão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Estado</th>
                            <th>Equipa</th>
                            <th>Data Conclusão</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($metas as $meta)


                          <tr>
                              <td>{{ $meta->idMeta }}</td>
                              <td>{{ $meta->titulos->titulo }}</td>
                              <td>{{ $meta->estado_metas->estado_meta }}</td>
                              <td>{{ $meta->equipas->nome_equipa }}</td>
                              <td>{{ $meta->data_conclusao }}</td>

                              <td>
                                <a href="{{ route('equipa.metas_mostrarUma',$meta->idMeta) }}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                <a href="{{ route('equipa.metas_edit', $meta->idMeta) }}" title="Atualizar" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                <a onclick="return confirm('Pretende eliminar estes dados?')" title="Eliminar" href="{{ route('equipa.metas_destroy',$meta->idMeta) }}" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                              </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


@endsection
