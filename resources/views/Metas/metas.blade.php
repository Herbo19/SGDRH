@extends('layout')
@section('title','SGDRH')

@section('content')

@php
use Carbon\Carbon;
$currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');
@endphp

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de Metas</h1>
    <br>
    <br>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todas as Metas</h6>
            <a  href="{{url('metas/create')}}" class="float-right btn btn-sm btn-success">Criar Novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Meta</th>
                            <th>Para</th>
                            <th>Data início</th>
                            <th>Data de Conclusão</th>
                            <th>Estado</th>
                            <th>Ações</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Meta</th>
                            <th>Para</th>
                            <th>Data início</th>
                            <th>Data de Conclusão</th>
                            <th>Estado</th>
                            <th>Ações</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($meta as $m)
                        @if(auth()->user()->idFuncionario == $m->atribuir_para)
                        <tr>
                            <td>{{$m->idMeta}}</td>
                            <td>{{$m->titulos->titulo ?? 'None'}}</td>
                            <td>{{$m->funcionario->nome_completo}}</td>
                            <td>{{ Carbon::parse($m->data_criacao)->diffForhumans() }}</td>
                            <td>{{ Carbon::parse($m->data_conclusao)->diffInDays() }} Dias</td>
                            <td>{{$m->estado_metas->estado_meta ?? 'None'}}</td>

                            <td>
                                <a href="{{url('metas/'.$m->idMeta)}}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                @if (auth()->user()->role == 'admin')
                                    <a href="{{url('metas/'.$m->idMeta.'/edit')}}" title="Atualizar" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                    <a onclick="return confirm('Pretende eliminar estes dados?')" title="Eliminar" href="{{url('metas/'.$m->idMeta.'/eliminar')}}" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                                @endif
                            </td>

                          </tr>
                        @endif
                          @endforeach
                        </tr>
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
