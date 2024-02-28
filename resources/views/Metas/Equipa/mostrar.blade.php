@extends('layout')
@section('title','SGDRH-Lista Meta-Equipa')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de Metas da Equipa: <span style="color: blue">{{ $team->nome_equipa }}</span> </h1>
    <br>
    <br>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todas Metas</h6>
            @if (auth()->user()->role == 'admin')
            <a href="{{ route('equipa.criar_meta') }}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Titulo</th>
                          <th>Data Conclusão</th>
                          <th>Estado</th>
                          <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Data Conclusão</th>
                            <th>Estado</th>
                            <th>Ações</th>
                          </tr>
                    </tfoot>
                    <tbody>
                        @foreach($metas as $meta)

                          <tr>
                              <td>{{$meta->idMeta}}</td>
                              <td>{{$meta->titulos->titulo}}</td>
                              <td>{{ $meta->data_conclusao }}</td>
                              <td>{{$meta->estado_metas->estado_meta ?? 'dont have'}}</td>
                              <td>
                                <a href="{{  route('mostrar_equipa.meta',$meta->idMeta )  }}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                @if (auth()->user()->role == 'admin')


                                @endif
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
