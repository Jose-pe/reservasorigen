<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Catedral Reservas</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/finalizar.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
           <img src="/img/logo-catedral.png" alt="">
          </div>
        </div>

        <div class="col-3 text-end">
          <a href="{{route('cliente_dashboard')}}" class="top-icon justify-content-end">
            <i class="bi bi-person"></i>
          </a>
        </div>

      </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

      <!-- SUCCESS -->
      <div class="success-icon">
        <i class="bi bi-check-lg"></i>
      </div>

      <!-- TITLE -->
      <h2 class="title">
        Reserva Confirmada
      </h2>

      <p class="subtitle">
        Se ha enviado un email de confirmación a tu dirección de correo.
      </p>

      <!-- RESERVA -->
      <div class="summary-box">

        <h3 class="summary-title">
          Tu reservación
        </h3>

        <div class="summary-row">
          <div class="summary-label">Nombre</div>
          <div class="summary-value" id="summaryName">
           usuario
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Invitados</div>
          <div class="summary-value" id="summaryGuests">
            personas
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Fecha</div>
          <div class="summary-value" id="summaryDate">
            fecha
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Hora</div>
          <div class="summary-value" id="summaryHour">
            hora
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Servicio</div>
          <div class="summary-value" id="summaryService">
            servicio
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Experiencia</div>
          <div class="summary-value">
            A la carta
          </div>
        </div>

      </div>

      
      <!-- PREFERENCIAS -->
      <div class="summary-box">

        <h3 class="summary-title">
          Preferencias
        </h3>

        <div class="summary-row">
          <div class="summary-label">
            Niños menores de 12
          </div>

          <div class="summary-value" id="summaryKids">
            --
          </div>
        </div>

        <div
          class="summary-row"
          id="foodRestrictionsRow"
          style="display:none;"
        >

          <div class="summary-label">
            Restricciones alimentarias
          </div>

          <div
            class="summary-value"
            id="summaryRestrictions"
          >
          </div>

        </div>

      </div>
         

    
    

      <!-- BUTTON -->
      <button
        class="finish-btn"
        id="finishBtn"
      >
        FINALIZAR
      </button>

      <!-- PROGRESS -->
      <div class="progress-wrapper">

        <div class="progress">
          <div class="progress-bar"></div>
        </div>

      </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
      desarrollado por <strong>Jose Luis Corazao</strong>
    </div>

  </div>

   <script src="/js/finalizar.js"></script>
   <script src="/js/bootstrap.js"></script>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>