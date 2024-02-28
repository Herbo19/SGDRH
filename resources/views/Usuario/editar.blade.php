@extends('layout')
@section('title','SGDRH - Editar Usuário')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editar Usuário: <strong>{{$userData->name}}</strong></h1>
    <br>
    @if (auth()->user()->role == 'admin')
    <a href="{{url('/usuario')}}" class="float-right btn btn-sm btn-success">Ver todos</a>
    @endif
    <br>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if(Session::has('nopass'))
            <p class="text-danger">{{session('nopass')}}</p>
          @endif

            <form method="POST" action="{{route('user.update',$userData->id)}}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="role_ante" value="{{$userData->role}}">
                <div class="row mb-2">

                    <img src="{{ URL::asset($userData->avatar) }}"
                    width="100" height="100" alt=""
                    class="rounded-circle" />

                        <input type="hidden" name="avatar_ante" value="{{$userData->avatar}}">

                </div>

                <div class="row mb-3">
                    <label for="#" class="col-md-4 col-form-label text-md-end"><b>{{ __('Avatar') }}</b> </label>
                    <input type="file" name="avatar" id="">
                </div>


                @if (auth()->user()->role == 'admin')
                <div class="row mb-3">
                    <label for="#" class="col-md-4 col-form-label text-md-end"><b>{{ __('Funcionário') }}</b> </label>
                    &nbsp
                    &nbsp
                    <select class="col-md-4" name="funcionarioId">
                        <option value="">-- Selecionar Funcionario --</option>
                        @foreach($func as $funcio)
                          <option @if($funcio->id==$userData->idFuncionario) selected @endif value="{{$funcio->id}}">{{$funcio->nome_completo.' '.$funcio->sobrenome}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Nome de Usuário') }}</b> </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$userData->name}}" required autocomplete="name" autofocus>

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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$userData->email}}" required autocomplete="email">

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

                @if (auth()->user()->role == 'admin')
                <div class="row mb-3">
                    <label for="" class="col-md-4 col-form-label text-md-end"><b>{{ __('Tipo') }}</b></label>
                    &nbsp
                    &nbsp
                    <select class="col-md-6" name="Tipo">
                        <option value="">-- Selecionar Tipo --</option>
                        @foreach($roles as $role)
                          <option @if(strtolower($role->titulo)==strtolower($userData->role)) selected @endif value="{{strtolower($role->titulo)}}">{{$role->titulo}}</option>
                        @endforeach
                      </select>
                </div>
                @endif

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

