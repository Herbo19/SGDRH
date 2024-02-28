@extends('layout')
@section('title','SGDRH-Criar Meta')

@section('content')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Criar Meta</h1>
                <!--  Esta  pagina levou {{ ((microtime(true) - LARAVEL_START)*1000) }} segundos para renderizar -->

                <!-- /.container-fluid -->
                @if (auth()->user()->role == 'admin')
                <a href="{{url('metas')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
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
                    <form class=""  method="post" action="{{url('metas')}}" enctype="multipart/form-data">
                        @csrf
                        <br>
                                  <div class="d-flex justify-content-center">
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <input type="text"  name="atribuir_para" id="searchFunc" class="form-control" aria-label="searchFunc"/>
                                        <label class="form-label" for="form3Example1m">Atribuir para</label>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <input type="text" name="titulo_meta" id="" class="form-control text-lowercase" />
                                        <label class="form-label" for="form3Example1n">Titulo da meta</label>
                                      </div>
                                    </div>
                                  </div>
<br>
                                  <div class="d-flex justify-content-center">
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <input type="date" name="data_inicio" id="startDate" class="form-control" />
                                        <label class="form-label" for="form3Example1m1">Data de Inicio</label>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-controll">
                                        <input type="date" name="data_fim" id="endDate" class="form-control" />
                                        <label class="form-label" for="form3Example1n1">Data de conclusão</label>
                                      </div>
                                    </div>
                                  </div>

<br>
                                  <div class="form-outline mb-3">
                                    &nbsp;&nbsp;
                                    <textarea class="col-sm-10" name="descricao_meta" cols="40" rows="5"></textarea><br>
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
