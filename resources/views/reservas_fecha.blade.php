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
    <div class="content">


  <!-- PERSONAS -->
  <div class="text-center mb-1">

    <div class="guest-pill">
      <i class="bi bi-people"></i>
      <span id="peopleSelected">2</span> Personas
    </div>

  </div>

  <!-- TITULO -->
  <h2 class="title">
    ¿Cuándo te gustaría visitarnos?
  </h2>

  <p class="subtitle">
    Selecciona tu fecha preferida
  </p>

  <!-- FECHAS -->
    <div class="date-slider" id="dateSlider"></div>

  <!-- CALENDARIO -->
  <div class="text-center mt-5">

    <button class="calendar-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="bi bi-calendar-event"></i>
      Ver calendario completo
    </button>
      <a href="/reservas_servicio" class="btn-continue mt-5">
        <i class="bi bi-calendar"></i>
         Confirmar fecha de reserva
      </a>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm"> <div class="modal-content border-0 shadow-lg rounded-4"> <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>

    <div class="modal-header border-bottom-0 pb-0 pt-4 d-flex justify-content-between align-items-center" style="padding-top: 3rem !important;">
      <button type="button" class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" id="prevMonth" style="width: 35px; height: 35px;">
        <i class="bi bi-chevron-left"></i>
      </button>
      
      <h5 id="monthDisplay" class="modal-title fw-bold text-dark mb-0"></h5>
      
      <button type="button" class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" id="nextMonth" style="width: 35px; height: 35px;">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>

    <div class="modal-body  pt-3 pb-2">
      <div class="table-responsive">
        <table class="table table-borderless align-middle text-center mb-0" style="table-layout: fixed;">
          <thead class="text-muted small text-uppercase">
            <tr>
              <th class="fw-normal">Dom</th>
              <th class="fw-normal">Lun</th>
              <th class="fw-normal">Mar</th>
              <th class="fw-normal">Mié</th>
              <th class="fw-normal">Jue</th>
              <th class="fw-normal">Vie</th>
              <th class="fw-normal">Sáb</th>
            </tr>
          </thead>
          <tbody id="calendarBody">
            </tbody>
        </table>
      </div>
    </div>

    <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex justify-content-center">
      <a href="/reservas_servicio" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2">
        <i class="bi bi-calendar-check"></i> Confirmar fecha
      </a>
    </div>

  </div>
</div>
</div>
  </div>

</div>
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
   
   <script src="/js/fechas_dinamicas.js"></script>
  <script src="/js/calendario.js"></script>
  <script src="/js/bootstrap.js"></script>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>







