@extends('layout')
@section('title','SGDRH - Mostrar Usuario')
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
            <h6 class="m-0 font-weight-bold text-primary">Mostrar Usuário : {{strtoupper($user->name)}}</h6>
            <a href="{{url('usuario')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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


            <img src="{{ $user->avatar }}" height="100" width="100" class="rounded-circle text-center"/>
              <div class="table-responsive">

                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">


                    <tr>
                        <th>Nome</th>
                        <td>
                          {{$user->name}}
                        </td>
                    </tr>

                    <tr>
                          <th>email</th>
                          <td>
                            {{$user->email}}
                          </td>
                    </tr>

                    <tr>
                      <th>Tipo</th>
                      <td>
                        {{$user->role}}
                      </td>
                    </tr>

                    <tr>
                      <th>Funcionario</th>
                      <td>
                        <a href="{{ url('/funcionario/'.$user->funcionarios->id) }}">{{$user->funcionarios->nome_completo. ' '. $user->funcionarios->sobrenome}}</a>
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
