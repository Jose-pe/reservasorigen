<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Catedral Reservas</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/preferencias.css">
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

      <!-- TOP -->
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
         <i class="bi bi-chevron-right text-secondary"></i>
         <div class="info-pill" id="hour-pill">
          12:00
        </div>

      </div>

      <!-- TITLE -->
      <h2 class="title">
        Personaliza tu experiencia
      </h2>

      <p class="subtitle">
        Ajusta tus preferencias
      </p>

      <!-- RESTRICCIONES -->
      <div class="option-block">

        <div class="option-row">

          <div class="option-label">
            Restricciones alimentarias
          </div>

          <div class="toggle-group">

            <button
              class="toggle-btn  active"
              onclick="toggleFood(false,this)"
            >
              NO
            </button>

            <button
              class="toggle-btn"
              onclick="toggleFood(true,this)"
            >
              SÍ
            </button>

          </div>

        </div>

        <textarea
          class="custom-textarea"
          id="foodTextarea"
          placeholder="Describe tus alergias o restricciones alimentarias..."
        ></textarea>

      </div>

      <!-- NIÑOS -->
      <div class="option-block">

        <div class="option-row">

          <div class="option-label">
            Niños menores de 12
          </div>

          <div class="toggle-group">

            <button
              class="toggle-btn active"
              onclick="toggleKids(false,this)"
            >
              NO
            </button>

            <button
              class="toggle-btn "
              onclick="toggleKids(true,this)"
            >
              SÍ
            </button>

          </div>

        </div>

        <!-- KIDS EXTRA -->
        <div class="kids-container" id="kidsContainer">

          <div class="kids-row">

            <div class="kids-label">
              ¿Cuántos?
            </div>

            <div class="counter">

              <button onclick="decreaseKids()">
                -
              </button>

              <div class="counter-value" id="kidsCount">
                0
              </div>

              <button onclick="increaseKids()">
                +
              </button>

            </div>

          </div>

        </div>

<hr>
    
      

        

      </div>

      <!-- BUTTON -->
      <button class="continue-btn" id="continueBtn">
        CONTINUAR
      </button>

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
    <p id="userPhone"> {{$phone_usuario}} </p>
    <script src="/js/preferencias.js"></script>
   <script src="/js/bootstrap.js"></script>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>