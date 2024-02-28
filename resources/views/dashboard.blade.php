@extends('layout')
@section('title','SGDRH-Perfil')

@section('content')

<?php
use Carbon\Carbon;


                $done=0;
                $prog=0;
                $Ndone=0;

    foreach ($metas as $stateCount) {
        if (auth()->user()->idFuncionario == $stateCount->atribuir_para) {
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

    <div class="main-body">

          <div class="row">
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
            </div>

            <div class="col-md-8 mb-3">
                <div class=" card mt-3">
                    <div class="card h-100">
                        <div class="card-body">
                          <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Individual</i>Progresso das Metas</h6>

                          @foreach($metas as $me)
                          @if(auth()->user()->idFuncionario == $me->atribuir_para)
                          @if ($me->idEstadoMeta == 2)
                          <small>{{ $me->titulos->titulo }}</small> &nbsp; <small class="float-right">Termina em:
                            &nbsp;{{ Carbon::parse($me->data_conclusao)->diffInDays() }} Dias</small>

                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          @endif
                          @endif
                          @endforeach
                        </div>
                      </div>
                  </div>
            </div>








            </div>

            <div class="row gutters-sm">

                <!-- Pie Chart -->
                <div class="col-sm-4 mb-3">
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

                <!-- Area Chart -->
                <div class="col-sm-8 mb-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                            <h6 class="m-0 font-weight-bold text-primary">QTD Metas concluidas por ano</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                            <hr>
                        </div>
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
                        @foreach($tableMetas as $m)
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
        var completedyear =JSON.parse('{!! json_encode($completedTasksByYear) !!}');
        var concluidas2 =JSON.parse('{!! json_encode($done) !!}');
        var Nconcluidas2 =JSON.parse('{!! json_encode($Ndone) !!}');
        var progresso2 =JSON.parse('{!! json_encode($prog) !!}');
     </script>


    @endsection
