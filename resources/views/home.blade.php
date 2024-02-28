@extends('layout')
@section('title','SGDRH-Home')

@section('content')

<div class="container">
    <!-- Begin Page Content -->
    <div class="container-fluid">

    @if(Session::has('error'))
        <p class="text-danger">{{session('error')}}</p>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 text-center">Seja Benvindo ao Sistema de Gestão de Desempenho de Recursos Humanos</h1>

    <!-- Area Chart -->
    <div class="card shadow mb-4">
        <img src="/imagens/backimage.png" width="" height="80%" class="">
    </div>


    </div>
    <!-- /.container-fluid -->

</div>

@endsection
