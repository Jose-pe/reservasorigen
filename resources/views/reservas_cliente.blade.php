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
          Bienvenido de nuevo
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

        <!-- EMAIL -->
        <a href="{{route('login')}}" class="email-btn">

          <i class="bi bi-envelope"></i>

          Continuar con Email

        </a>

        <!-- PASSWORD -->
        <div class="password-login">

          <i class="bi bi-lock"></i>

          Iniciar sesión con contraseña

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