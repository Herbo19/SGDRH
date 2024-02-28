@extends('layout')
@section('title','SGDRH-Perfil')

@section('content')

<?php
use Carbon\Carbon;

    $done=0;
                $prog=0;
                $Ndone=0;

    foreach ($allMetas as $stateCount) {
        if ($employeeId == $stateCount->atribuir_para) {
            if ($stateCount->idEstadoMeta == '1') {
                $done++;
            } elseif ($stateCount->idEstadoMeta == '2') {
                $prog++;
            }else{
                $Ndone++;
            }
    }





}
?>

<div class="container">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a id="download" name="download"  href="{{url('/generate-pdf/'.$user->id)}}" target="_blank"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
</div>
    <div class="main-body">

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ $user->avatar}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $user->name}}</h4>
                      <p class="text-secondary mb-1">Cargo: &nbsp;{{ $user->funcionarios->cargos->tituloCargo}}</p>
                      <p class="text-muted font-size-sm">Departamento: &nbsp;{{ $user->funcionarios->departamento->nome}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Individual</i>Metas em Progresso</h6>

                      @foreach ($metaEmProg as $metaProg)
                        @if ($metaProg->atribuir_para == $user->funcionarios->id)
                            <small>{{ $metaProg->titulos->titulo }}</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                      @endforeach


                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome Completo :</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->funcionarios->nome_completo.' '.$user->funcionarios->sobrenome}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email :</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Telefone :</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->funcionarios->telefones->telefone}}&nbsp; || &nbsp; {{ $user->funcionarios->telefones->telefone2}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Data de aniversário:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->funcionarios->data_nascimento}} &nbsp;&nbsp; <span>({{ Carbon::parse($user->funcionarios->data_nascimento)->age }}) anos</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="{{ url('usuario/'.$id.'/edit') }}">Editar</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                    <!-- Pie Chart -->
                    <div class="col-sm-12 mb-3">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Metas</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Concluidas
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-warning"></i> Em progresso
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-danger"></i> Não Concluidas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>




          </div>



        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metas concluidas por ano</h6>
            </div>
            <div class="card-body">
                <canvas id="canvas" height="280" width="600"></canvas>
            </div>
        </div>




    </div>



          <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Todas as Metas</h6>
            <a href="{{url('metas/create')}}" class="float-right btn btn-sm btn-success">Criar Novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Para</th>
                            <th>Inicio</th>
                            <th>Fim</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Para</th>
                            <th>Inicio</th>
                            <th>Fim</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($allMetas as $m)
                        @if($user->funcionarios->id == $m->atribuir_para)
                        <tr>
                            <td>{{$m->idMeta}}</td>
                            <td>{{$m->titulos->titulo ?? 'None'}}</td>
                            <td>{{$m->funcionario->nome_completo}}</td>
                            <td>{{ Carbon::parse($m->data_criacao)->diffForhumans() }}</td>
                            <td>{{ Carbon::parse($m->data_conclusao)->diffInDays() }} Dias</td>
                            <td>{{$m->estado_metas->estado_meta ?? 'None'}}</td>

                            <td>
                              <a href="{{url('metas/'.$m->idMeta)}}" title="Mostrar" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                            </td>

                          </tr>
                        @endif
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        </div>
    </div>


    <script type="text/javascript">
        var dataBa =JSON.parse('{!! json_encode($dataToBar) !!}');
        var concluidas2 =JSON.parse('{!! json_encode($done) !!}');
        var Nconcluidas2 =JSON.parse('{!! json_encode($Ndone) !!}');
        var progresso2 =JSON.parse('{!! json_encode($prog) !!}');

    const years = dataBa.map(item => item.year);
    const counts = dataBa.map(item => item.count);
    var barChartData = {
    labels: years,
    datasets: [{
        label: 'QTD Metas',
        backgroundColor: "#4e73df",
        data: counts
    }]
    };


    window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 1,
                    borderColor: '#c1c1c1',
                    borderSkipped: 'bottom'
                }
            },
            responsive: true,
            title: {
                display: true,
                text: 'Metas Concluidas Ano'
            }
        }
    });
    };
     </script>


    @endsection
