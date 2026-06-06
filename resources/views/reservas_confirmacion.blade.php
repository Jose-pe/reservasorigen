<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>Catedral Reservas</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/confirmacion.css">
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
    <div class="content">

      <!-- TOP INFO -->
      <div class="top-pills">

        <div class="info-pill" id="peoplePill">
          2 Personas
        </div>

        <i class="bi bi-chevron-right text-secondary"></i>

        <div class="info-pill" id="datePill">
          dom 24, may
        </div>

        <i class="bi bi-chevron-right text-secondary"></i>

        <div class="info-pill" id="hourPill">
          22:00
        </div>

      </div>

      <!-- TITLE -->
      <h2 class="title">
        Tu reserva aún no está confirmada
      </h2>

      <p class="subtitle">
        Revisá los detalles y confirmá para asegurar tu lugar.
      </p>

      <!-- RESUMEN -->
      <div class="summary-box">

        <h3 class="summary-title">
          Resumen de la Reserva
        </h3>

        <div class="summary-row">
          <div class="summary-label">Nombre</div>
          <div class="summary-value" id="summaryName">
            {{$nombre_usuario}}
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Comensales</div>
          <div class="summary-value" id="summaryGuests">
            2 Personas
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Fecha</div>
          <div class="summary-value" id="summaryDate">
            domingo, mayo 24, 2026
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Hora</div>
          <div class="summary-value" id="summaryHour">
            22:00
          </div>
        </div>

        <div class="summary-row">
          <div class="summary-label">Servicio</div>
          <div class="summary-value" id="summaryService">
            Cena
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
            1
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


      <button  class="reserve-btn" id="reserveBtn">
        RESERVAR
      </button>
      <!-- BUTTON -->
      

    </div>

    <!-- BOTTOM -->
    <div class="bottom">

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

   <script src="/js/confirmacion.js"></script>
   <script src="/js/send_data.js"></script>
   <script src="/js/bootstrap.js"></script>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>