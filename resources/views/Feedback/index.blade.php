@extends('layout')
@section('title','SGDRH')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de Cargos</h1>
    <br>
    <br>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todos Cargos</h6>
            <a href="{{url('cargo/create')}}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @if($data)
                        @foreach($data as $d)
                          <tr>
                              <td>{{$d->id}}</td>
                              <td>{{$d->tituloCargo}}</td>
                              <td>{{$d->descricao}}</td>
                              <td>
                                <a href="{{url('cargo/'.$d->id)}}" class="btn btn-warning btn-sm">Mostrar</a>
                                <a href="{{url('cargo/'.$d->id.'/edit')}}" class="btn btn-primary btn-sm">Atualizar</a>
                                <a onclick="return confirm('Pretende eliminar estes dados?')" href="{{url('cargo/'.$d->id.'/eliminar')}}" class="btn btn-danger btn-sm">Eliminar</a>
                              </td>
                            </tr>
                          @endforeach
                        @endif
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
