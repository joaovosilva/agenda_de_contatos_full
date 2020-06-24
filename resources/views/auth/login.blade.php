@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/skel.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/init.js')}}"></script>
<noscript>
    <link rel="stylesheet" href="{{asset('assets/css/skel.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style-desktop.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style-noscript.css')}}" />
</noscript>
<!-- Wrapper-->
<div id="wrapper">
    <!-- Nav -->
    <nav id="nav">
        <a href="#login" class="icon fa-sign-in active"><span>@lang('login.login')</span></a>
        <a href="#register" class="icon fa-user-plus"><span>@lang('login.register')</span></a>
    </nav>

    <!-- Main -->
    <div id="main">
        <div id="vueLogin">
            <!-- login -->
            <article id="login" class="panel">
                <a href="#register" class="jumplink pic" id="register-link">
                    <p>@lang('login.not_member') <br> @lang('login.register_now')</p>
                    <span class="arrow icon fa-chevron-right"></span>
                </a>
                <div class="formulario">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4">{{ __('login.email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4">{{ __('login.password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('login.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('login.login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('login.forgot_password') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </article>

            <!-- register -->
            <article id="register" class="panel">
                <a href="#login" class="jumplink pic" id="login-link">
                    <p>@lang('login.already_member')<br>@lang('login.login_now')</p>
                    <span class="arrow icon fa-chevron-left"><span></span></span>
                </a>
                <div class="formulario">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4">{{ __('login.name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4">{{ __('login.email') }}</label>

                            <div class="col-md-8">
                                <input id="emailRegister" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4">{{ __('login.password') }}</label>

                            <div class="col-md-8">
                                <input id="passwordRegister" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4">{{ __('login.confirm_password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('login.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('assets/js/browser.min.js')}}"></script>
<script src="{{asset('assets/js/breakpoints.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/util.js')}}"></script>
@endsection
