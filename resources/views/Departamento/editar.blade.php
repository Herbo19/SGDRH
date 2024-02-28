@extends('layout')
@section('title','SGDRH-Editar Departamento')
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
            <h6 class="m-0 font-weight-bold text-primary">Editar Departamento</h6>
            <a href="{{url('depart')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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
          <form class=""  method="post" action="{{url('depart/'.$data->id)}}">
            @method('put')
            @csrf
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                    <tr>
                      <th>Nome</th>
                      <td>
                        <input type="text" class="form-control" name="nome" value="{{$data->nome}}">
                      </td>
                    </tr>
                    <tr>
                      <th>Descrição</th>
                      <td>
                        <input type="text" class="form-control" name="descricao" value="{{$data->descricao}}">
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
