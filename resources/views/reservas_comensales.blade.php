<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Catedral Reservas</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  
</head>
<body>
 
   
  <div class="main-card">
    <!-- HEADER -->
    <div class="top-bar">

      <div class="row align-items-center">

        <div class="col-3">
          <a href="#" class="top-icon">
            <i class="bi bi-globe"></i>
            ES
          </a>
        </div>

        <div class="col-6">
          <div class="logo">
                       <img src="img/logo-catedral.png" alt="">

          </div>
        </div>

        <div class="col-3 text-end">
          {{--  <a href="#" class="top-icon justify-content-end">
            <i class="bi bi-person"></i>
          </a>--}}
        </div>

      </div>

    </div>

    <!-- CONTENT -->
   <div class="content" id="guestScreen">

      <h2 class="title">
        ¿Cuántos comensales?
      </h2>

      <p class="subtitle">
        Selecciona el tamaño de tu grupo
      </p>

      <!-- CARDS -->
      <div class="guest-grid">

            <div class="guest-card" onclick="selectGuests(1)">
        <div class="guest-number">1</div>
        <div class="guest-text">persona</div>
        </div>

        <div class="guest-card" onclick="selectGuests(2)">
        <div class="guest-number">2</div>
        <div class="guest-text">personas</div>
        </div>

        <div class="guest-card" onclick="selectGuests(3)">
        <div class="guest-number">3</div>
        <div class="guest-text">personas</div>
        </div>

        <div class="guest-card" onclick="selectGuests(4)">
        <div class="guest-number">4</div>
        <div class="guest-text">personas</div>
        </div>

      </div>

      <!-- CUSTOM -->
      <div class="custom-box">

        <div class="custom-title">
          Tamaño personalizado
        </div>

        <div class="counter-box">

          <button class="counter-btn" onclick="decreaseGuests()">
            -
          </button>

          <div class="counter-center p-2">
            <h3 id="guestCount">2</h3>
            
          </div>

          <button class="counter-btn" onclick="increaseGuests()">
            +
          </button>

        </div>

      </div>

      <!-- BUTTON -->
         <button class="btn-continue" id="continueGuests">
        <i class="bi bi-people"></i>
        Continuar con
        <span id="continueCount">2</span>
        comensales
        </button>
    </div>

    <!-- BOTTOM -->
   
    <!-- ========================= -->
<!-- PANTALLA FECHA RESERVA -->
<!-- ========================= -->
 
 <!-- ========================= -->
<!-- PANTALLA SERVICIOS -->
<!-- ========================= -->


 <div class="bottom">

      <div class="progress-wrapper">

       
        <div class="progress">
          <div class="progress-bar-c"></div>
        </div>

      </div>

    </div>
    <!-- FOOTER -->
    <div class="footer">
      desarrollado por <strong>Jose Luis Corazao</strong>
    </div>

  </div>
   
  <script src="/js/reservaciones.js"></script>
   
  <script>
    document
  .getElementById('continueGuests')
  .addEventListener('click', ()=>{

    // guardar invitados
    localStorage.setItem(
      'campoGuests',
      guests
    );
    

    // actualizar pill
  
  });
 
    </script>

</body>
</html>