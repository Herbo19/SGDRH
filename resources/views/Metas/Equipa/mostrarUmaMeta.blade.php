@extends('layout')
@section('title','SGDRH-Mostrar Meta')
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
            <h6 class="m-0 font-weight-bold text-primary">Mostrar Meta: {{ $meta->titulos->titulo }}</h6>
            <a href="{{url('equipa/metas/todas')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
        </div>
        <div class="card-body">

          <form class=""  method="post" action="#" enctype="multipart/form-data">
            @method('put')
            @csrf
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">

                    <tr>
                        <th>Título da meta</th>
                        <td>
                          {{ $meta->titulos->titulo }}
                        </td>
                    </tr>

                    <tr>
                        <th>De</th>
                        <td>
                          {{ $meta->atribuido_por }}
                        </td>
                    </tr>

                    <tr>
                      <th>Para</th>
                      <td>
                        {{ $meta->equipas->nome_equipa }}
                      </td>

                    </tr>

                    <tr>
                      <th>Inicio</th>
                      <td>
                        {{ $meta->data_criacao }}
                      </td>
                    </tr>

                    <tr>
                        <th>Fim</th>
                        <td>
                            {{ $meta->data_conclusao }}
                        </td>
                    </tr>

                    <tr>
                        <th>Descrição</th>
                        <td>
                            {{ $meta->descricao_meta }}
                        </td>
                    </tr>

                      <tr>
                        <th>Estado</th>
                        <td>
                            {{ $meta->estado_metas->estado_meta }}
                        </td>
                      </tr>

                  </table>
              </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection
