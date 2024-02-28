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
        <h5 class="card-title">Resumo do desempenho do funcionário</h5>

        <!-- Employee Information -->
        <p><strong>Nome Funcionário:</strong> {{ $user->funcionarios->nome_completo.' '.$user->funcionarios->sobrenome }}</p>
        <p><strong>Cargo:</strong> {{ $user->funcionarios->cargos->tituloCargo }}</p>
        <p><strong>Departamento:</strong> {{ $user->funcionarios->departamento->nome }}</p>
        <p><strong>Metas concluidas:</strong> {{ $countConc }}</p>
        <p><strong>Metas em progresso:</strong> {{ $countProg }}</p>
        <p><strong>Metas não concluidas:</strong> {{ $countNConc }}</p>
        <hr>

        <!-- Goal Progress -->
        <h6 class="card-subtitle mb-2 text-muted">Metas em Progresso</h6>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Meta</th>
                <th>Data de inicio</th>
                <th>Data de termino</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($metas as $meta)
                    @if ($meta->idEstadoMeta == "2")
                        <tr>
                            <td>{{ $meta->idMeta ?? '-' }}</td>
                            <td>{{ $meta->titulos->titulo ?? '-' }}</td>
                            <td>{{ $meta->data_criacao ?? '-/-/-'}}</td>
                            <td>{{ $meta->data_conclusao ?? '-/-/-'}}</td>
                        </tr>
                    @endif
                @endforeach
              <!-- Add more goal entries here -->
            </tbody>
          </table>
        </div>


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
                        @foreach ($dataToBars as $dataToBar)
                                <tr>
                                    <td>{{ $dataToBar->year ?? 'none' }}</td>
                                    <td>{{ $dataToBar->count ?? '-' }}</td>
                                </tr>
                        @endforeach
                      <!-- Add more goal entries here -->
                    </tbody>
                  </table>
            </div>
        </div>

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
                        @foreach ($completedGoalPercentages as $percentage)
                                <tr>
                                    <td>{{ $percentage->year ?? 'none' }}</td>
                                    <td>{{ ($percentage->completed_count / $percentage->total_count) * 100 ?? '-' }}</td>
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
