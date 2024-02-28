@extends('layout')
@section('title','SGDRH-Editar Funcionario')
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
            <h6 class="m-0 font-weight-bold text-primary">Atualizar Funcionário</h6>
            <a href="{{url('funcionario')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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

          <form class=""  method="post" action="{{url('funcionario/'.$data->id)}}" enctype="multipart/form-data">
            @method('put')
            @csrf
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                    <img src="{{$data->foto}}" width="100" height="100" alt="" class="rounded-circle" />
                    <tr>
                        <th>Foto</th>
                        <td>
                          <input type="file" class="form-control" name="foto" value="{{$data->foto}}">
                          <p>
                            <input type="hidden" name="foto_ante" value="{{$data->foto}}">
                          </p>
                        </td>
                    </tr>

                    <tr>
                        <th>Nome</th>
                        <td>
                          <input type="text" class="form-control" name="nome_completo" value="{{$data->nome_completo}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Sobrenome</th>
                        <td>
                          <input type="text" class="form-control" name="sobrenome" value="{{$data->sobrenome}}">
                        </td>
                    </tr>

                    <tr>
                      <th>Cargo</th>
                      <td>
                        <select class="form-control" name="cargo">
                          <option value="">-- Selecionar Cargo --</option>
                          @foreach($carg as $cargo)
                            <option @if($cargo->id==$data->id_cargo) selected @endif value="{{$cargo->id}}">{{$cargo->tituloCargo}}</option>
                          @endforeach
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <th>Departamento</th>
                      <td>
                        <select class="form-control" name="depart">
                          <option value="">-- Selecionar Departamento --</option>
                          @foreach($departs as $depart)
                            <option @if($depart->id==$data->id_departamento) selected @endif value="{{$depart->id}}">{{$depart->nome}}</option>
                          @endforeach
                        </select>
                      </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>
                          <input type="text" class="form-control" name="endereco" value="{{$data->emails->email}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Data de Nascimento</th>
                        <td>
                            <input type="date" class="form-control" name="dataNasc" value="{{ $data->data_nascimento }}">
                        </td>
                    </tr>

                      <tr>
                          <th>Genero</th>
                          <td>
                              <select class="form-control" name="genero">
                                @foreach($generos as $gen)
                                  <option @if($gen->idGenero == $data->idGenero) selected @endif value="{{$gen->idGenero}}">{{$gen->genero}}</option>
                                @endforeach
                              </select>
                            </td>
                      </tr>

                    <tr>
                      <th>Telefone</th>
                      <td>
                        <input type="text" class="form-control" name="telefone" value="{{$data->telefones->telefone}}">
                      </td>
                    </tr>

                    <tr>
                        <th>Telefone 2</th>
                        <td>
                          <input type="text" class="form-control" name="telefone2" value="{{$data->telefones->telefone2}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Estado</th>
                        <td>
                          @foreach($estad as $est)
                                  <input @if($est->idEstado == $data->idEstado) checked @endif type="radio" class="" name="estado" value="{{$est->idEstado}}">&nbsp {{$est->estado}} <br>
                          @endforeach
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
