@extends('layout')
@section('title','SGDRH-Criar Meta-Equipa')

@section('content')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Criar Meta para Equipa</h1>
                <!--  Esta  pagina levou {{ ((microtime(true) - LARAVEL_START)*1000) }} segundos para renderizar -->

                <!-- /.container-fluid -->
                @if (auth()->user()->role == 'admin')
                <a href="{{ route('equipa.metas_todas') }}" class="float-right btn btn-sm btn-success">Ver todos</a>
                @endif
                <br><br>


                @if($errors->any())
                @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
                @endforeach
                @endif

                @if(Session::has('msg'))
                    <p class="text-success">{{session('msg')}}</p>
                @endif

                @if(Session::has('col'))
                    <p class="text-danger">{{session('col')}}</p>
                @endif


                <div class="card shadow ">
                    <form class=""  method="post" action="{{ route('equipa.store_meta') }}" enctype="multipart/form-data">
                        @csrf
                        <br>
                                  <div class="d-flex justify-content-center">
                                    <div class="col-sm-6">
                                        <label for="team_id">Seleciona a equipa:</label>
                                        <select class="form-control" id="team_id" name="team_id">
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->idEquipa }}">{{ $team->nome_equipa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <label class="form-label" for="form3Example1n">Titulo da meta</label>
                                        <input type="text" name="titulo_meta" id="" class="form-control text-lowercase" />
                                      </div>
                                    </div>
                                  </div>
<br>
                                  <div class="d-flex justify-content-center">
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <label class="form-label" for="form3Example1m1">Data de Inicio</label>
                                        <input type="date" name="data_inicio" id="startDate" class="form-control" />

                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <label class="form-label" for="form3Example1n1">Data de Fim</label>
                                        <input type="date" name="data_fim" id="endDate" class="form-control" />

                                      </div>
                                    </div>
                                  </div>

                                  <br>

<br>
                                  <div class="form-outline mb-3">
                                    &nbsp;&nbsp;

                                    <textarea class="col-sm-10" name="descricao_meta" cols="40" rows="5" placeholder="Digite alguma coisa que possa ajudar a entender melhor a meta"></textarea><br>
                                    &nbsp;&nbsp;
                                    <label class="form-label" for="form3Example8">Descrição</label>
                                  </div>

                                  <input type="hidden" name="atribuido_por" value="{{ auth()->user()->name }}">

                                  <div class="d-flex justify-content-end pt-2">
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                  </div>
                                </form>
                </div>

            </div>
        <!-- End of Main Content -->



@endsection
