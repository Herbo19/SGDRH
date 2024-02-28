@extends('layout')
@section('title','SGDRH-Dashboard')
@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Desempenho</h1>
        <a href="{{ url('/generateAdmin-pdf') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Funcionários (Quantidade registados) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Funcionários</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@if($numFun<0) {{$numFun=0}} @else {{$numFun}}  @endif</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departamentos (Quantidade registados) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Departamentos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@if($numDep<0) {{$numDep=0}} @else {{$numDep}}  @endif</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metas Totais Concluidas(ano) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Metas Concluidas
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $concluidas }} %</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar
                                        @if(round(($concluidas),1)>=50)
                                            bg-info
                                        @elseif (round(($concluidas),1)>=45)
                                            bg-warning
                                        @else
                                            bg-danger
                                        @endif
                                        " role="progressbar"
                                            style="width: {{ $concluidas }}%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback feitos Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Equipas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $numEquipa ?? '0' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Funcionários com mais metas completas</h6>
                </div>
                <div class="card-body">
                @foreach ($Concemployees as $Concemployee)

                    <h4 class="small font-weight-bold"><a style="color:gray" href="{{ url('/perfil/'.$Concemployee->id) }}">{{ $Concemployee->nome_completo.' '.$Concemployee->sobrenome }}</a><span
                            class="float-right">{{ round(($Concemployee->completed_tasks_count / $Concemployee->total_tasks_count)*100,1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar"
                        style="width: {{ round(($Concemployee->completed_tasks_count / $Concemployee->total_tasks_count)*100,1) }}%"
                            aria-valuenow="{{ round(($Concemployee->completed_tasks_count / $Concemployee->total_tasks_count)*100,1) }}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                @endforeach
            </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
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
                            <i class="fas fa-circle text-warning"></i> Em Progresso
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Não concluidas
                        </span>
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



        <div class="row">
              <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">

    </div>





    <script type="text/javascript">
    var dataBar =JSON.parse('{!! json_encode($daBar) !!}');
      var concluidas2 =JSON.parse('{!! json_encode($mc) !!}');
      var Nconcluidas2 =JSON.parse('{!! json_encode($mn) !!}');
      var progresso2 =JSON.parse('{!! json_encode($mp) !!}');


      const years = dataBar.map(item => item.year);
    const counts = dataBar.map(item => ((item.completed_count / item.total_count) * 100).toFixed(2));
    var barChartData = {
    labels: years,
    datasets: [{
        label: '% Metas',
        backgroundColor: "#2193b0",
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
                text: '%Metas Concluidas Ano'
            }
        }
    });
    };
    </script>



@endsection
