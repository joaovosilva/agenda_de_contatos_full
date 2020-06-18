<!DOCTYPE html>
<!--
	Astral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Agenda de Contatos - Login</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
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
</head>

<body>
    <!-- Wrapper-->
    <div id="wrapper">
        <!-- Nav -->
        <nav id="nav">
            <a href="#login" class="icon fa-sign-in active"><span>Logar</span></a>
            <a href="#register" class="icon fa-user-plus"><span>Cadastrar</span></a>
        </nav>

        <!-- Main -->
        <div id="main">
            <div id="vueLogin">
                <!-- login -->
                <article id="login" class="panel">
                    <a href="#register" class="jumplink pic" id="register-link">
                        <p>Não é membro? <br> Cadastre-se já!</p>
                        <span class="arrow icon fa-chevron-right"></span>
                    </a>
                    <div class="formulario">
                        <form method="POST" action="{{ route('login') }} class="form-login">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="">Email: </label>
                                <input id="email" name="email" placeholder="Email..." ref="email" type="text"
                                    class="form-control" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password" class="">Senha: </label>
                                <input id="password" name="password" placeholder="Senha..." ref="password" type="password"
                                    class="form-control" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button
                                    class="align-self-end button-gradient float-right btn btn-secondary">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </article>

                <!-- register -->
                <article id="register" class="panel">
                    <a href="#login" class="jumplink pic" id="login-link">
                        <p>Já é um membro? <br> Faça login!</p>
                        <span class="arrow icon fa-chevron-left"><span></span></span>
                    </a>
                    <div class="formulario">
                        <form class="form-login">
                            <div class="form-group">
                                <label for="nameRegister" class="">Nome: </label>
                                <input name="nameRegister" placeholder="Nome..." type="text" class="form-control"
                                    value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="emailRegister" class="">Email: </label>
                                <input name="emailRegister" placeholder="Email..." type="text" class="form-control"
                                    value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="passwordRegister" class="">Senha: </label>
                                <input name="passwordRegister" placeholder="Senha..." type="password"
                                    class="form-control" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="passwordRegisterConfirm" class="">Confirme sua senha: </label>
                                <input name="passwordRegisterConfirm" placeholder="Senha..." type="password"
                                    class="form-control" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button
                                    class="align-self-end button-gradient float-right btn btn-secondary">Registrar</button>
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
</body>

</html>