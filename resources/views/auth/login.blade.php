<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Iniciar Sesión</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/reserva_login.css">
    <link rel="stylesheet" href="/css/telefono.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

 
</head>
<body>

  <div class="login-wrapper">

    <div class="login-card">

      <!-- CONTENT -->
      <div class="login-content">

        <h1 class="title">
          Iniciar sesión
        </h1>

        <p class="subtitle">
          Bienvenido
        </p>

        <!-- GOOGLE -->
        <a href={{ url('auth/google') }} class="social-btn">

          <img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
            alt="Google"
          >

          Continuar con Google

        </a>

      
     

        <!-- DIVIDER -->
        <div class="divider">

          <div class="divider-line"></div>

          <span>o</span>

          <div class="divider-line"></div>

        </div>
        <form action="{{route('login')}}" method="post">

            @csrf
            
             <div class="input-group-custom">

          <i class="bi bi-envelope input-icon"></i>
             <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese su e-mail">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        

        </div>
         <div class="input-group-custom">
             <i class="bi bi-key input-icon"></i>
         <input id="password" type="password" placeholder="Ingrese una contraseña" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

          </div>  
           <button class="email-btn" type="submit">

          <i class="bi bi-envelope"></i>

          Iniciar Sesion con e-mail

        </button> 
        </form>
        <!-- EMAIL -->
       

        <!-- PASSWORD -->
        <div class="password-login">

          <i class="bi bi-lock"></i>

          Olvidé mi contraseña

        </div>

        <!-- REGISTER -->
        <div class="register-text">

          ¿No tienes una cuenta?

          <a href="{{route('register')}}">
            Registrarse
          </a>

        </div>

      </div>

     

    </div>

    <!-- FOOTER -->
    <div class="footer">

      Powered by <strong>Jose Luis Corazao</strong>

    </div>

  </div>

</body>
</html>


{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

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
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}