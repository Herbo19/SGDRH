@extends('layout')
@section('title','SGDRH-Editar Meta')
@section('content')
<link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    @php
        use Carbon\Carbon;
    @endphp


<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Atualizar Meta</h6>
            <a onclick="window.history.back()" class="float-right btn btn-sm btn-success">Ver todos</a>
        </div>
        <div class="card-body">
          @if($errors->any())
            @foreach($errors->all() as $error)
              <p class="text-danger">{{$error}}</p>
            @endforeach
          @endif

          @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
          @endif

          @if(Session::has('stg'))
            <p class="text-danger">{{session('stg')}}</p>
          @endif


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
                        {{ $meta->funcionario->nome_completo.' '. $meta->funcionario->sobrenome }}
                      </td>
                    </tr>

                    <tr>
                      <th>Inicio</th>
                      <td>
                        {{ $meta->data_criacao }} &nbsp; &nbsp; <span>/{{ Carbon::parse($meta->data_criacao)->diffForhumans() }}</span>
                      </td>
                    </tr>

                    <tr>
                        <th>Fim</th>
                        <td>
                            {{ $meta->data_conclusao }} &nbsp; &nbsp; <span>/{{ Carbon::parse($meta->data_conclusao)->diffForhumans() }}</span>
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


                    <tr>
                      <td colspan="2">

                        @if (($meta->estado_metas->estado_meta == "em progresso" && !(auth()->user()->role == 'admin')) || (auth()->user()->role == 'admin'))
                        <a href="{{ url('/estado/'.$meta->idMeta.'/metas') }}" class="btn btn-info">Atualizar Estado</a>
                        @endif

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
