@extends('layout')
@section('title','SGDRH - Criar Equipa')

@section('content')


<!-- Begin Page Content -->
<div class="row">
    <div class="col-sm-3">
        <form method="POST" action="{{ route('equipas.store') }}">
            @csrf

            @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
            @endif

            @if(Session::has('tipo-eliminado'))
            <p class="text-danger">{{session('tipo-eliminado')}}</p>
            @endif

            <div class="form-group">
                <label for="equipa">Equipa</label>
                <input type="text" name="equipa" id="equipa" class="form-control @error('equipa') is-invalid @enderror">

                <label for="descricao">Descrição</label>
                <textarea rows="1" cols="40" id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror"></textarea>
                <div>
                    @error('titulo')
                        <span class=""><strong>{{ $message }}</strong></span>
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
                <h6 class="m-0 font-weight-bold text-primary">Criar Equipa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Equipa</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Equipa</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($equipas as $equipa)
                            <tr>
                                <td>{{ $equipa->idEquipa }}</td>
                                <td><a href="{{ route('equipas.show', $equipa->idEquipa) }}">{{ $equipa->nome_equipa }}</a></td>
                                <td>{{ $equipa->descricao }}</td>
                                <td>
                                    <a onclick="return confirm('Pretende eliminar estes dados?')" href="{{ url('/equipas/'.$equipa->idEquipa) }}"
                                    class="btn btn-danger btn-sm">Eliminar</a>

                                    <a href="{{ route('equipas.editar', $equipa->idEquipa) }}" class="btn btn-primary btn-sm">Atualizar</a>
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
