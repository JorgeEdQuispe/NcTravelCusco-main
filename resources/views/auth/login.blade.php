<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reportes - Mit Viajes ✈</title>
    <link rel="icon" href="https://www.mitviajes.com/wp-content/uploads/2019/03/cropped-Favicon-Mit-Viajes.png" />
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/nuevos.css') }}">
    @yield('metas')
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f8f8;
        border-bottom: none;
        font-weight: bold;
    }

    .form-control {
        border-radius: 0;
        border-color: #dcdcdc;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #4e86e4;
        border-color: #4e86e4;
    }

    .btn-primary:hover {
        background-color: #4072c0;
        border-color: #4072c0;
    }

    .btn-link {
        color: #4e86e4;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #4072c0;
        text-decoration: none;
    }

    .logo {
        width: 200px;
        max-width: 200px;
    }

    @media (max-width: 576px) {
        .container {
            padding: 20px;
        }
    }
</style>

<body>
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-xl-2">
                    <a href="/"><img
                            src="https://www.mitviajes.com/wp-content/uploads/2019/03/Logo-Mit-Viajes.png"
                            alt="Logo Trilha Salkantay" class="logo"></a>
                </div>
            </div>
        </div>
    </header>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 row">
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
                            <div class="mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
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
                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link"
                                            href="{{ route('password.request') }}">{{ __('Olvidaste tu contraseña?') }}</a>
                                    @endif
                                    {{-- <a class="btn btn-info" href="{{ __('register') }}">Registrarse</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
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
