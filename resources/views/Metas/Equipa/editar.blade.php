@extends('layout')
@section('title','SGDRH-Editar Meta')
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
            <h6 class="m-0 font-weight-bold text-primary">Atualizar Meta</h6>
            <a href="{{url('equipa/metas/todas')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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

          <form class=""  method="post" action="{{ route('equipa.metas_update', $meta->idMeta) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">

                    <tr>
                        <th>Título da meta</th>
                        <td>
                          <input type="text" class="form-control" name="titulo_meta" value="{{ $meta->titulos->titulo }}">
                          <input type="hidden" class="form-control" name="id_titulo_meta" value="{{ $meta->titulos->idTitulo }}">
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
                        <select class="form-control" name="team_id">
                            <option value="">-- Selecionar Equipa --</option>
                            @foreach($equipas as $equipa)
                                <option @if($meta->idEquipa==$equipa->idEquipa) selected @endif value="{{$equipa->idEquipa}}">{{$equipa->nome_equipa}}</option>
                            @endforeach
                        </select>
                      </td>

                    </tr>

                    <tr>
                      <th>Inicio</th>
                      <td>
                        <input type="date" class="form-control" name="data_inicio" value="{{ $meta->data_criacao }}">
                      </td>
                    </tr>

                    <tr>
                        <th>Fim</th>
                        <td>
                            <input type="date" class="form-control" name="data_fim" value="{{ $meta->data_conclusao }}">
                        </td>
                    </tr>

                    <tr>
                        <th>Descrição</th>
                        <td>
                            <input type="text" class="form-control" name="descricao_meta" value="{{ $meta->descricao_meta }}">
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
                        <input type="submit" class="btn btn-info" name="" value="Enviar">
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
