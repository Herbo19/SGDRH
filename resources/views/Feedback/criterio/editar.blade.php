@extends('layout')
@section('title','SGDRH')
@section('content')
<link href="{{asset("vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Begin Page Content -->

<div class="col-sm-6">
    <h1> Editar : {{ $criterio->criterio }}</h1>
    <br><br>

    <form method="post" action="{{ route('criterio.update', $criterio->idCriterio) }}">
        @csrf
        @method('PUT')

        @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
          @endif

        <div class="form-group">
            <label for="criterio">Critério</label>
            <input type="text" name="criterio" id="criterio" class="form-control" value="{{$criterio->criterio }}">
        </div>

        <button class="btn btn-info" type="submit">Atualizar</button>
        <a href="{{route('feedback.criterio.show')}}" class="btn btn-primary float-right">Listar</a>
    </form>
</div>

<!-- End of Main Content -->

@endsection
