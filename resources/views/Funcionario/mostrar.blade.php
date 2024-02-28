@extends('layout')
@section('title','SGDRH')
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
            <h6 class="m-0 font-weight-bold text-primary">Mostrar Funcionário : {{ strtoupper($data->nome_completo." ".$data->sobrenome) }}</h6>
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
          <form class=""  method="post" action="{{url('funcionario/'.$data->id)}}" enctype="multipart/form-data">
            @method('put')
            @csrf

            <img src="{{ $data->foto }}" height="100" width="100" class="rounded-circle text-center"/>
              <div class="table-responsive">

                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">


                    <tr>
                        <th>Nome</th>
                        <td>
                          {{$data->nome_completo}}
                        </td>
                    </tr>

                    <tr>
                          <th>Sobrenome</th>
                          <td>
                            {{$data->sobrenome}}
                          </td>
                    </tr>

                    <tr>
                      <th>Cargo</th>
                      <td>
                        {{$data->cargos->tituloCargo}}
                      </td>
                    </tr>

                    <tr>
                      <th>Departamento</th>
                      <td>
                        {{$data->departamento->nome}}
                      </td>
                    </tr>



                    <tr>
                        <th>Data de Nascimento</th>
                        <td>
                          {{ date('d-m-Y', strtotime($data->data_nascimento))}}
                        </td>
                    </tr>

                    <tr>
                        <th>Genero</th>
                        <td>
                          {{ $data->generos->genero}}
                        </td>
                    </tr>



                    <tr>
                      <th>Email</th>
                      <td>
                        {{$data->emails->email}}
                      </td>
                    </tr>

                    <tr>
                      <th>Telefone</th>
                      <td>
                        {{$data->telefones->telefone}}
                      </td>
                    </tr>

                    <tr>
                        <th>Telefone 2</th>
                        <td>
                          {{$data->telefones->telefone2}}
                        </td>
                      </tr>

                    <tr>
                      <th>Estado</th>
                      <td>
                        {{$data->estados->estado}}
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
