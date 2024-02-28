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
            <a href="{{url('metas')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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

          <form class=""  method="post" action="{{ route('metas.update',$meta->idMeta) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">

                    <tr>
                        <th>Título da meta</th>
                        <td>
                          <input type="text" class="form-control" name="titulo_meta" value="{{ $meta->titulos->titulo }}">
                          <input type="hidden"  name="id_titulo_meta" value="{{ $meta->titulos->idTitulo }}">
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
                        <select class="form-control" name="atribuir_para">
                            <option value="">-- Selecionar Funcionario --</option>
                            @foreach($funcs as $func)
                                <option @if($meta->atribuir_para==$func->id) selected @endif value="{{$func->id}}">{{$func->nome_completo.' '.$func->sobrenome}}</option>
                            @endforeach
                        </select>
                      </td>

                    </tr>

                    <tr>
                      <th>Inicio</th>
                      <td>
                        <input type="date" class="form-control" name="data_criacao" value="{{ $meta->data_criacao }}">
                      </td>
                    </tr>

                    <tr>
                        <th>Fim</th>
                        <td>
                            <input type="date" class="form-control" name="data_conclusao" value="{{ $meta->data_conclusao }}">
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
