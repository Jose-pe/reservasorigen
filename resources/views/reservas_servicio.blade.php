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
  <link rel="stylesheet" href="css/service.css">
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
      

  <!-- PILLS -->
  <div class="text-center mb-5">

    <div class="service-top-info">

      <div class="guest-pill">
        <i class="bi bi-people"></i>
        <span id="servicePeople">2</span> Personas
      </div>

      <i class="bi bi-chevron-right"></i>

      <div class="guest-pill" id="serviceDate">
        vie 29, may
      </div>

    </div>

  </div>

  <!-- TITULO -->
  <h2 class="title">
    Selecciona un servicio
  </h2>

  <p class="subtitle">
    Elige tu horario preferido
  </p>

  <!-- OPCIONES -->
  <div class="service-options">

    <button
      class="service-card"
      onclick="selectService('Almuerzo', this)"
    >
      Almuerzo
    </button>

    <button
      class="service-card"
      onclick="selectService('Cena', this)"
    >
      Cena
    </button>

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

   <script src="/js/servicio.js"></script> 
  <script src="/js/bootstrap.js"></script>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>