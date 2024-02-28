@extends('layouts.app')

@section('content')

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>Benvindo ao SGDRH!</b></h1>
                                    </div>

                                    @if($errors->any())
                                      @foreach($errors->all() as $error)
                                        <p class="text-danger">{{$error}}</p>
                                      @endforeach
                                    @endif

                                    @if(Session::has('msg'))
                                    <p class="text-danger">{{session('msg')}}</p>
                                    @endif

                                    <form class="user" method="post" action="{{ route('login') }}">
                                      @csrf


                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" aria-describedby="emailHelp" value="{{ old('email') }}"
                                                placeholder="Insira o Email " required autocomplete="email" autofocus>

                                        </div>


                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" placeholder="Senha" required autocomplete="current-password">

                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Lembrar-me') }}
                                            </label>
                                        </div>
                                        <br>

                                        <input type="submit" class="btn btn-info btn-user btn-block" name="" value="login">

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Esqueceu a senha?') }}
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
