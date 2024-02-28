@extends('layout')
@section('title','SGDRH - Listar Usuário')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listar Usuários</h1>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todos Usuários</h6>
            <a href="{{url('usuario/create')}}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
        </div>
        <div class="card-body">
            @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
          @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome de Usuario</th>
                            <th>Avatar</th>
                            <th>Criação</th>
                            <th>Atualização</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome de Usuario</th>
                            <th>Avatar</th>
                            <th>Criação</th>
                            <th>Atualização</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{url('perfil/'.$user->id)}}">{{ $user->name }}</a></td>
                                <td><img src="{{ $user->avatar }}" height="80px" alt="" /></td>
                                <td>{{ $user->created_at->diffForhumans()}}</td>
                                <td>{{ $user->updated_at->diffForhumans()}}</td>
                                <td>
                                    <a href="{{route('user.mostrar',$user->id)}}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                    <a href="{{route('user.edit',$user->id )}}" title="Atualizar" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                    <a onclick="return confirm('Pretende eliminar estes dados?')" title="Eliminar" href="{{route('user.eliminar',$user->id)}}"
                                    class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                                  </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


@endsection
