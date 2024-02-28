@extends('layout')
@section('title','SGDRH')
@section('content')
<link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Begin Page Content -->

<div class="col-sm-6">
    <h1> Editar : {{ $role ->titulo }}</h1>

    <form method="post" action="{{ route('tipo.atualizar', $role->id) }}">
        @csrf
        @method('PUT')

        @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
          @endif

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $role->titulo }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $role->descricao }}">
        </div>

        <button class="btn btn-info" type="submit">Atualizar</button>
        <a href="{{route('tipo.show')}}" class="btn btn-primary float-right">Listar</a>
    </form>
</div>

<!-- End of Main Content -->

@endsection
