@extends('layout')
@section('title','SGDRH')
@section('content')
<link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Begin Page Content -->

<div class="col-sm-6">
    <h1> Editar : {{ $editMeta->titulos->titulo }}</h1>

    <form method="post" action="{{ route('meta.estado.atualizar',$editMeta->idMeta) }}">
        @method('PUT')
        @csrf


        @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
          @endif

        <div class="form-group">
            <label for="descricao">Estado</label>
            <select class="form-control" name="estado_meta">
                <option value="">-- Selecionar Estado --</option>
                @foreach($editEstado as $editEstad)
                    <option @if($editEstad->idEstadoMeta==$editMeta->idEstadoMeta)
                        selected @endif value="{{$editEstad->idEstadoMeta}}">
                        {{$editEstad->estado_meta}}
                    </option>
                @endforeach
              </select>
        </div>

        <button class="btn btn-info" type="submit">Atualizar</button>

        <a href="{{route('mostrar_equipa.meta',$editMeta->idMeta)}}" class="btn btn-primary float-right">Ver</a>
    </form>
</div>

<!-- End of Main Content -->

@endsection
