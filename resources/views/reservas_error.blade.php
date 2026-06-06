<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Error Reservas</title>

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

        <h4 class="title fs-1">
          <strong>!!! ERROR AL REGISTRAR SU RESERVA !!!</strong>
        </h4>

        <p class="subtitle text-danger fw-bolder">
         USTED YA TIENE UNA RESERVA PARA ESTA FECHA O ALGO SALIO MAL, VUELVA A INTENTERLO.
        </p>

        <!-- GOOGLE -->
        <a href={{ url('/reservas_comensales') }}  class="email-btn text-decoration-none">

          

          INTENTAR NUEVAMENTE

        </a>

      
     

        <!-- DIVIDER -->
    

        <!-- EMAIL -->
     
        <!-- PASSWORD -->
       

        <!-- REGISTER -->
      

      </div>

      <!-- BOTTOM -->
     

    </div>

    <!-- FOOTER -->
    <div class="footer">

      Powered by <strong>Jose Luis Corazao</strong>

    </div>

  </div>
  <script>
        localStorage.removeItem('campoService');
        localStorage.removeItem('campoReservation');
        localStorage.removeItem('campoPreferences');
        localStorage.removeItem('campoHour');
        localStorage.removeItem('campoGuests');
        localStorage.removeItem('campoDate');

  </script>
</body>
</html>