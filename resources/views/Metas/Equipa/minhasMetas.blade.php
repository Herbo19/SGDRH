@extends('layout')
@section('title','SGDRH - Minhas Metas de Equipas')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Minhas Equipas</h1>
    <br>
    <br>
    <br>
    @if (count($teams) > 0)
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todas Equipas</h6>
            <a href="{{ url('equipas/create') }}" class="float-right btn btn-sm btn-success">Adicionar Novo</a>
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

                            @foreach ($teams as $team)
                                <tr>
                                <td>{{ $team->idEquipa }}</td>
                                <td><a href="{{ url('/equipas/'.$team->idEquipa.'/mostrar') }}">{{ $team->nome_equipa }}</a></td>
                                <td>{{ $team->descricao }}</td>
                                <td>
                                    <a href="{{ url('/equipa/metas/'.$team->idEquipa) }}" class="btn btn-warning btn-sm">metas</a>
                                </td>
                                </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @else
        <p class="text-gray-900">Não estas associado a nenhuma equipa.</p>
    @endif

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


@endsection
