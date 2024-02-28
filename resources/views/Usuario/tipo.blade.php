@extends('layout')
@section('title','SGDRH - Tipo de Usuário')

@section('content')


<!-- Begin Page Content -->
<div class="row">
    <div class="col-sm-3">
        <form method="POST" action="{{ route('tipo.store') }}">
            @csrf

            @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
            @endif

            @if(Session::has('tipo-eliminado'))
            <p class="text-danger">{{session('tipo-eliminado')}}</p>
            @endif

            @if(Session::has('erro'))
            <p class="text-danger">{{session('erro')}}</p>
            @endif

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror">
                <div>
                    @error('titulo')
                        <span class=""><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror">

                <div>
                    @error('descricao')
                        <span><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-info btn-block">Criar</button>
        </form>
        </div>


    <div class="col-sm-9">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tipos de Usuários</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Descrição</th>
                                <th>Opções</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td><a href="{{ route('tipo.editar',$role->id) }}">{{ $role->titulo }}</a></td>
                                    <td>{{ $role->descricao }}</td>
                                    <td>
                                        <a onclick="return confirm('Pretende eliminar estes dados?')" href="{{ url('usuario/'.$role->id.'/eliminar') }}"
                                        class="btn btn-danger btn-sm">Eliminar</a>

                                        <a href="{{ route('tipo.editar',$role->id) }}" class="btn btn-primary btn-sm">Atualizar</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- End of Main Content -->


@endsection
