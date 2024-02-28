@extends('layout')
@section('title','SGDRH - Registar Usuário')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Criar Usuário</h1>
    <br>
    <a href="{{url('metas')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
    <br>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <form method="POST" action="{{ route('user.update'), $id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


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
                    <select class="form-control" name="depart">
                        <option value="">-- Selecionar Departamento --</option>
                        @foreach($departamentos as $depart)
                          <option value="{{$depart->id}}">{{$depart->nome}}</option>
                        @endforeach
                      </select>
                </div>

                <div class="row mb-3">
                    <label for="#" class="col-md-4 col-form-label text-md-end"><b>{{ __('Funcionário') }}</b> </label>
                    &nbsp
                    &nbsp
                    <select class="col-md-4" name="tipo">
                        <option value="0">Funcionario 1</option>
                        <option value="1">Funcionario 2</option>
                      </select>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Nome de Usuário') }}</b> </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name" autofocus>

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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" required autocomplete="email">

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
                    <select class="col-md-4" name="tipo">
                        <option value="0">Usuario Normal</option>
                        <option value="1">Admin</option>
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
