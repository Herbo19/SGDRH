@extends('layout')
@section('title','SGDRH - Registar Usuário')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Criar Usuário</h1>
    <br>
    <a href="{{url('/usuario')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
    <br>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if(Session::has('nopass'))
            <p class="text-danger">{{session('nopass')}}</p>
          @endif

          @if(Session::has('msg'))
            <p class="text-sucess">{{session('msg')}}</p>
          @endif

            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-2">
                    <img class="img-profile rounded-circle" width="90"
                    height="100"
                    src="img/undraw_profile.svg">

                </div>

                <div class="row mb-3">
                    <label for="#" class="col-md-4 col-form-label text-md-end"><b>{{ __('Avatar') }}</b> </label>
                    <input type="file" name="avatar" id="">
                </div>



                <div class="row mb-3">
                    <label for="#" class="col-md-4 col-form-label text-md-end"><b>{{ __('Funcionário') }}</b> </label>
                    &nbsp
                    &nbsp
                    <select class="col-md-4" name="funcionarioId">
                        <option value="">-- Selecionar Funcionario --</option>
                        @foreach($func as $funcio)
                          <option value="{{$funcio->id}}">{{$funcio->nome_completo.' '.$funcio->sobrenome}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Nome de Usuário') }}</b> </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('Email') }}</b> </label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Senha') }}</b> </label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><b> {{ __('Confirmar Senha') }}</b></label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                    </div>
                </div>
<b></b>
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-form-label text-md-end"><b>{{ __('Tipo') }}</b></label>
                    &nbsp
                    &nbsp
                    <select class="col-md-6" name="Tipo">
                        <option value="">-- Selecionar Tipo --</option>
                        @foreach($roles as $role)
                          <option value="{{$role->titulo}}">{{$role->titulo}}</option>
                        @endforeach
                      </select>
                </div>
                <br>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="float-right btn btn-info">
                            {{ __('Enviar') }}
                        </button>
                </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->




@endsection

