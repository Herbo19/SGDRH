@extends('layout')
@section('title','SGDRH - Mostrar Equipa')
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
            <h6 class="m-0 font-weight-bold text-primary">Mostrar Equipa: {{ $equipa->nome_equipa }}</h6>
            <a href="{{ route('meta.quipas_metas', $equipa->idEquipa) }}" class="float-right btn btn-sm btn-info mr-1">Ver Metas</a>
            &nbsp;
            @if (auth()->user()->role == 'admin')
            <a href="{{route('equipa.criar_meta')}}" class="float-right btn btn-sm btn-primary mr-1">Criar Meta</a>
            <a href="{{url('equipas/create')}}" class="float-right btn btn-sm btn-success mr-1">Ver todos</a>
            @endif
        </div>
        <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="10%" cellspacing="0">
                    <tr>
                      <th>Equipa</th>
                      <td>
                        {{$equipa->nome_equipa}}
                      </td>
                    </tr>
                    <tr>
                      <th>Descrição</th>
                      <td>
                        {{$equipa->descricao}}
                      </td>
                    </tr>
                  </table>
              </div>
        </div>
    </div>



    <!-- Funcionarios da equipa -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Funcionários da Equipa : {{ $equipa->nome_equipa }}</h6>
            @if (auth()->user()->role == 'admin')
            <a href="{{ route('addTo.equipa',$equipa->idEquipa)}}" class="float-right btn btn-sm btn-primary">Adicionar</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($equipa->funcionario as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->nome_completo.' '.$employee->sobrenome }}</td>
                            <td>
                                @if (auth()->user()->role == 'admin')
                                <a href="#" class="btn btn-warning btn-sm">Mostrar</a>
                                <form action="{{ route('funcionario.tirar_equipa',[$equipa->idEquipa, $employee->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Pretende Remover o funcionario da equipa?')" class="btn btn-danger btn-sm"
                                    type="submit" class="btn btn-link">Remover</button>
                                @else
                                    nenhuma
                                @endif
                                </form>
                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End of Main Content -->

@endsection
