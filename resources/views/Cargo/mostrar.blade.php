@extends('layout')
@section('title','SGDRH - Mostrar Cargo')
@section('content')
<link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mostrar Cargo</h6>
            <a href="{{url('cargo')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
        </div>
        <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                    <tr>
                      <th>Titulo</th>
                      <td>
                        {{$data->tituloCargo}}
                      </td>
                    </tr>
                    <tr>
                      <th>Descrição</th>
                      <td>
                        {{$data->descricao}}
                      </td>
                    </tr>
                  </table>
              </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection
