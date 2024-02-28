@extends('layout')
@section('title','SGDRH-Lista de Funcionários')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de Funcionários</h1>
    <br>
    <br>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todos Funcionários</h6>
            <a href="{{url('funcionario/create')}}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Foto</th>
                          <th>Email</th>
                          <th>Cargo</th>
                          <th>Departamento</th>
                          <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Foto</th>
                          <th>Email</th>
                          <th>Cargo</th>
                          <th>Departamento</th>
                          <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @if($data)
                        @foreach($data as $d)

                          <tr>
                              <td>{{$d->id}}</td>
                              <td>{{$d->nome_completo}}</td>
                              <td><img src="{{ $d->foto }}" width="80" alt="" /></td>
                              <td>{{$d->emails->email ?? 'dont have'}}</td>
                              <td>{{$d->cargos->tituloCargo}}</td>
                              <td>{{$d->departamento->nome}}</td>
                              <td>
                                <a href="{{url('funcionario/'.$d->id)}}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                <a href="{{url('funcionario/'.$d->id.'/edit')}}" title="Atualizar" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                <a onclick="return confirm('Pretende eliminar estes dados?')" title="Eliminar" href="{{url('funcionario/'.$d->id.'/eliminar')}}" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
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
