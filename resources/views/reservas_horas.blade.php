<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Catedral Reservas</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  
  <link rel="stylesheet" href="/css/service.css">
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

      <!-- PILLS -->
      <div class="top-pills">

        <div class="info-pill" >
           <i class="bi bi-people"></i>
      <span id="peopleSelected">2</span> Personas
        </div>

        <i class="bi bi-chevron-right text-secondary"></i>

        <div class="info-pill" id="serviceDate">
          vie 29, may
        </div>

        <i class="bi bi-chevron-right text-secondary"></i>

        <div class="info-pill" id="service-pill">
          Almuerzo
        </div>

      </div>

      <!-- TITULO -->
      <h2 class="title">
        Selecciona una hora
      </h2>

      <p class="subtitle">
        Elige un horario disponible
      </p>

      <!-- ICON -->
      <div class="arrow-icon">
        <i class="bi bi-chevron-expand"></i>
      </div>

      <!-- HORARIOS -->
      <div class="time-list" id="timeList"></div>

    </div>

    <!-- BOTTOM -->
    <div class="bottom">

      <div class="progress-wrapper">

      

        <div class="progress">
          <div class="progress-bar-h"></div>
        </div>

      </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
      desarrollado por <strong>Jose Luis Corazao</strong>
    </div>

  </div>
  <script src="/js/hour_service.js"></script>  

</body>
</html>