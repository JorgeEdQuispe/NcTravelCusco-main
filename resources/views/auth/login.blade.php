<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('titulo') - NC Travel Cusco ✈</title>
    <link rel="icon" href="{{ asset('img/nc-travel-favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nuevos.css') }}">
    @yield('metas')
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-xl-2">
                    <a href="/"><img src="{{ asset('img/Logo-Salkantay-trilha-inca.png') }}"
                            alt="Logo Trilha Salkantay" class="logo"></a>
                </div>
                <div class="col-12 col-md-8 d-none d-xl-block">
                    
                </div>

                <div class="col-12 col-md-2 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-left" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="social">
                                <a href="https://www.facebook.com/MachupicchuCusco" class="nav-link" target="_blank">
                                    <span class="icon-facebook"></span>
                                </a>
                            </li>
                            <li class="social">
                                <a href="https://www.instagram.com/nctravelcusco_oficial/" class="nav-link"
                                    target="_blank">
                                    <span class="icon-instagram"></span>
                                </a>
                            </li>
                            <li class="social"><a href="https://www.pinterest.es/nctravelcusco/" class="nav-link"
                                    target="_blank">
                                    <span class="icon-pinterest"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a
                        href="#" class="site-menu-toggle js-menu-toggle float-right"><span
                            class="icon-menu h3"></span></a>
                </div>
            </div>
        </div>

    </header>
    <div class="row justify-content-center" style="padding-top:8em; padding-bottom:8em">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                                {{-- <a class="btn btn-info" href="{{ __('register') }}">
                                    Registrarse
                                </a> --}}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <img class="btn-whatsapp" src="{{ asset('img/Nc-travel-Whatsapp.png') }}" alt="Whatsapp Nc Travel Cusco"
            onclick="window.open('https://wa.me/51984606757?text=Oi%20voce%20pode%20me%20ajudar.')"
            style="padding:0px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4"><span class="line-left"></span></div>
                <div class="col-lg-4 text-center">
                    <a href="https://www.facebook.com/MachupicchuCusco" class="social-foot" target="_blank" alt="Facebook Nc Travel Cusco">
                        <span class="icon-facebook"></span>
                    </a>
                    <a href="https://www.instagram.com/nctravelcusco_oficial/" class="social-foot" target="_blank" alt="Instagram Nc Travel">
                        <span class="icon-instagram"></span>
                    </a>
                    <a href="#" class="social-foot" target="_blank" alt="Trip Advisor Nc Travel">
                        <span class="icon-tripadvisor"></span>
                    </a>
                    <a href="https://www.pinterest.es/nctravelcusco/" class="social-foot" target="_blank" alt="Pinterest NC Travel Cusco">
                        <span class="icon-pinterest"></span>
                    </a>
                </div>
                <div class="col-lg-4"><span class="line-right"></span></div>
            </div>

            <div class="row pt-5">
                <div class="col-lg-4 logo-foot">
                    <img src="{{ asset('img/Trilha-Inca-Machu-Picchu.png') }}" alt="Logo Salkantay Trilha Inca"
                        style="padding: 0em">
                    <ul>
                        <li><a href="{{ route('nosotros') }}">Quem Somos</a></li>
                        <li><a href="{{ route('contato') }}">Contato</a></li>
                        <li><a href="">Nossa localização</a></li>
                        <li><a href="{{ route('condicoes') }}">Condições Gerais</a></li>
                        <li><a href="">Pagamento</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Passeios mais populares</h4>
                    <div class="linea"></div>
                    <ul>
                        <li><a href="https://www.trilhaincacuzco.com/cusco-classico-opcional-3dias">Cusco Classico
                                Opcional 3 Dias e 2 Noites</a> </li>
                    </ul>
                    <ul>
                        <li><a href="https://www.trilhaincacuzco.com/cusco-classico-pernoite-4dias">Cusco Classico
                                Tradicional 4 Dias e 3 Noites</a> </li>
                    </ul>
                    <ul>
                        <li><a href="https://www.trilhaincacuzco.com/cusco-classico-imperial-6dias">Cusco Classico
                                Imperial 6 Dias e 5 Noites</a> </li>
                    </ul>
                    <ul>
                        <li><a href="https://www.trilhaincacuzco.com/trilha-inca-jungle-machu-picchu-4dias">Trilha Inca
                                Clássica 4 Dias e 3 Noites</a> </li>
                    </ul>
                    <ul>
                        <li><a href="https://www.trilhaincacuzco.com/trilha-salkantay-machu-picchu-4dias">Trilha
                                Salkantay Machu Picchu 5 Dias e 4 Noites</a> </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Inquéritos</h4>
                    <div class="linea"></div>
                    <ul>
                        <li><a href="mailto:nctravelcusco@gmail.com"><i class="icon-envelope-o"></i>
                                info@nctravelcusco.com</a> </li>
                    </ul>
                    <ul>
                        <li><a href="mailto:nctravelcusco@gmail.com"><i class="icon-envelope-o"></i>
                                nikocworld@hotmail.com</a></li>
                    </ul>
                    <ul>
                        <li><a><i class="icon-whatsapp"></i>&nbsp; +51 984606757</a> </li>
                    </ul>
                    <ul>
                        <li><i class="icon-phone"></i>&nbsp; +51 84 235190 </li>
                    </ul>
                    <ul>
                        <li><i class="icon-map-marker"></i>&nbsp; Av. 28 Julio Pasaje San Martin X2 – 16 Dep 201 - Ttio
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="down">
                <div class="col-lg-12 text-center links">
                        <a href="http://www.nctravelcusco.com/" target="_blank">NC Travel Cusco</a>
                        <a href="https://www.pacotesperu.com/" target="_blank">Pacotes Perú</a>
                        <a href="https://www.trilhasalkantay.com/" target="_blank">Trilha Salkantay</a>
                        <a href="https://www.balsaspiuray.com/" target="_blank">Balsas Piuray</a>
                </div>
                <p><strong>NC Travel Cusco SAC</strong> direitos autorais ©2023 | Trekking e caminhadas no Peru, todos
                    os direitos autorais.</p>
            </div>
        </div>
    </div>
    <div id="popupSearch" onclick="cerrarSearch()">
        <div id="search-content" onclick="stopPropagation(event)">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Pesquisar passeios no Peru</h4>
                    <form action="{{ route('search') }}" method="get">
                        @csrf
                        <div class="input-group">
                            <div class="form-outline">
                                <input type="search" id="name" name="name" class="form-control" />
                            </div>
                            <input type="submit" style="border:none" class="btn-inicio" value="Procurar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/djm2.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
