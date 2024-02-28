<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Desempenho</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Include your custom styles if needed -->

  <style>
    /* Your custom styles go here */
  </style>
</head>
<body>

@php
    use Carbon\Carbon;
@endphp


  <div class="container mt-5">
    <h1 class="mb-4">Relatório de desempenho</h1>

    <!-- Report Content -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Resumo do desempenho GLOBAL</h5>

        <!-- Employee Information -->
        <p><strong>Funcionarios:</strong> {{ $FunCount}}</p>
        <p><strong>Cargos:</strong> {{ $CarCount}}</p>
        <p><strong>Departamentos:</strong> {{ $DepCount }}</p>
        <p><strong>Equipas:</strong> {{ $equipaCount }}</p>
        <p><strong>Metas concluidas:</strong> {{ $concluidaCount }} </p>
        <p><strong>Metas em progresso:</strong> {{ $progCount }}</p>
        <p><strong>Metas não concluidas:</strong> {{ $nconcluidaCount }} </p>
        <p><strong>Total Metas:</strong> {{ $totalMetas }} </p>
        <br>
        <br>
        <hr>


        <!-- Lista de funcionarios -->
        <h6 class="card-subtitle mb-2 text-muted">Lista de Funcionarios</h6>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Data de registo</th>
                <th>Data Nascimento</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($Fun as $funcionario)
                <tr>
                    <td>{{  $funcionario->id }}</td>
                    <td>{{  $funcionario->nome_completo.' '.$funcionario->sobrenome }}</td>
                    <td>{{ $funcionario->created_at}}</td>
                    <td>{{ $funcionario->data_nascimento }}</td>
                </tr>
                @endforeach


              <!-- Add more goal entries here -->
            </tbody>
          </table>
        </div>

        <br>
        <br>
        <hr>
        <!-- Lista de Departamentos -->
        <h6 class="card-subtitle mb-2 text-muted">Lista de Departamentos</h6>
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nome Departamento</th>
                <th>Data de registo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($Dep as $Depart)
                <tr>
                    <td>{{  $Depart->id }}</td>
                    <td>{{  $Depart->nome }}</td>
                    <td>{{ $Depart->created_at}}</td>
                </tr>
                @endforeach


                <!-- Add more goal entries here -->
            </tbody>
            </table>
        </div>

        <br>
        <br>
        <hr>
        <!-- Lista de Cargos -->
        <h6 class="card-subtitle mb-2 text-muted">Lista de Cargos</h6>
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Cargo</th>
                <th>Data de registo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($Car as $Cargo)
                <tr>
                    <td>{{  $Cargo->id }}</td>
                    <td>{{  $Cargo->tituloCargo }}</td>
                    <td>{{ $Cargo->created_at}}</td>
                </tr>
                @endforeach


                <!-- Add more goal entries here -->
            </tbody>
            </table>
        </div>

        <br>
        <br>
        <hr>
        <!-- Lista de Equipas -->
        <h6 class="card-subtitle mb-2 text-muted">Lista de Equipas</h6>
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Equipa</th>
                <th>Data de registo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($equipa as $eq)
                <tr>
                    <td>{{  $eq->idEquipa }}</td>
                    <td>{{  $eq->nome_equipa }}</td>
                    <td>{{ $eq->created_at}}</td>
                </tr>
                @endforeach


                <!-- Add more goal entries here -->
            </tbody>
            </table>
        </div>

        <br>
        <hr>


        <div class="card mt-5 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metas concluidas por ano</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Ano</th>
                        <th>QTD metas Completas</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach ($goalsPerYear as $item)
                <tr>
                    <td>{{  $item->year }}</td>
                    <td>{{ $item->goal_count }}</td>
                </tr>
                @endforeach


                      <!-- Add more goal entries here -->
                    </tbody>
                  </table>
            </div>
        </div>

        <hr>

        <div class="card mt-5 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metas concluidas por ano</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Ano</th>
                        <th>% metas Completas</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($goalCompletionPercentages as $data)
                        <tr>
                            <td>{{  $data->year }}</td>
                            <td>{{ number_format(($data->completed_count / $data->total_count) * 100, 2) }}% </p></td>
                        </tr>
                    @endforeach


                      <!-- Add more goal entries here -->
                    </tbody>
                  </table>
            </div>
        </div>


      </div>
    </div>



    <!-- Additional report sections can be added here -->


<!-- Footer -->
<footer class="sticky-footer bg-white py-3">
    <div class="mt-5">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; SGDRH 2023</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

  </div>



  <!-- Include Bootstrap JS, Chart.js, and any additional scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>
</html>
