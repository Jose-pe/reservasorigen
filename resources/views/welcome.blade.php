<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Origen Restaurant</title>
    
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://unpkg.com">

    <link rel="icon" type="image/png" href="favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/origen.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" media="print" onload="this.media='all'">
    <link href="/css/origen_experiencias.css" rel="stylesheet" media="print" onload="this.media='all'">
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" media="print" onload="this.media='all'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" media="print" onload="this.media='all'">
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top">
     <a class="navbar navbar-brand ms-3" href="#"> 
         <img class="img-fluid logo" src="/img-origen/logo-origen-dorado.webp" alt="restaurant origen cusco logo" width="160" height="55" fetchpriority="high">
     </a>

    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav text-start text-lg-start">
        <a class="nav-link" href="#">Inicio</a>
        <a class="nav-link" href="#galeria">Galería</a>
        <a class="nav-link" href="{{route('reservas_comensales')}}">Reservas</a>
        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver Menú</a>
        <a class="nav-link" href="#contactanos">Contáctanos</a>    
      </div>   
      <div class="d-flex ms-auto justify-content-start justify-content-lg-end mt-3 me-3 mt-lg-0">
         <a class="nav-link pe-2" href="#"> ES </a> / 
         <a class="nav-link ps-2" href="/eng"> EN </a>
     </div>
    </div>  
</nav>

<section class="hero-ultra min-vh-100 d-flex align-items-center justify-content-center">
  <div class="hero-layer hero-bg" fetchpriority="high"></div>
  <div class="hero-layer hero-overlay"></div>
  <div class="hero-layer hero-light"></div>

  <div class="hero-content text-center">
    <h1 class="hero-title">O    R    I    G    E    N</h1>
    <p class="hero-sub">Alta cocina contemporánea</p>
    <a href="{{route('reservas_comensales')}}" class="btn-reserva-main">RESERVA CON NOSOTROS</a>
  </div>
</section>

<section class="section text-center mt-5 mb-5">
  <div class="container py-5 px-3">
    <h2 class="mb-4 mt-3" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">Nosotros</h2>
    <p class="mx-auto" style="max-width:1800px;" data-aos="fade-up" data-aos-duration="1300" data-aos-easing="ease-in-sine">
       Origen Cusco invita a reconectarnos con nuestros orígenes a través de una experiencia que honra la tradición cusqueña desde una visión contemporánea.
       Su propuesta integra arquitectura, materiales y gastronomía inspirados en la identidad del Perú, creando un espacio donde la historia se siente viva y se expresa con elegancia, autenticidad y carácter.
    </p>
  </div>
</section>

<section class="section container-fluid">
  <div class="row align-items-center">
    <div class="col-12 col-lg-6" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">
       <div class="p-3 p-md-5">
          <h2 class="text-start mb-4">Gastronomía</h2>
          <p class="text-start">
             En Origen Cusco cada plato ha sido creado como una expression de identidad, donde la gastronomía se convierte en un relato de nuestra cultura. A través de ingredientes locales, técnicas cuidadas y una presentación contemporánea, cada preparación representa una parte de nuestras raíces y tradiciones, reinterpretadas con respeto y creatividad para ofrecer una experiencia auténtica y significativa.
          </p>
          <div class="text-center">
              <button type="button" class="button-cartas pt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                 VER MENÚ
              </button>
          </div>
       </div>
    </div>
    <div class="col-md-6 img-container" data-aos="zoom-in-left" data-aos-duration="1000" data-aos-easing="ease-in-sine" id="imgsection">
      <div class="img-box">
        <img src="/img-origen/origen-sec-1.webp" class="img-fluid w-100" alt="Origen Cusco" loading="lazy" width="800" height="533">
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="background_experiencias">
      <div class="modal-header">
        <h5 class="modal-title fw-bolder" id="staticBackdropLabel" style="color: #D8B36A !important; font-size: 1.5rem;">CARTAS Y MENÚ</h5>
        <button type="button" class="btn-close" style="background-color: rgba(255, 255, 255, 0.541) !important;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a target="_blank" href="/carta-origen/carta_origen.pdf" class="menu-link fw-bolder"> <i class="fas fa-utensils"></i> VER CARTA DE MENÚ</a>  <br><br>
        <a target="_blank" href="/carta-origen/carta_bar_origen.pdf" class="menu-link fw-bolder"> <i class="fas fa-wine-bottle"></i> VER CARTA DE BAR</a><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn p-3 bt-lg" id="btn-mas" data-bs-dismiss="modal">C E R R A R</button>         
      </div>
    </div>
  </div>
</div>

<section class="section container-fluid">
  <div class="row align-items-center flex-md-row-reverse">
    <div class="col-md-6" data-aos="zoom-in-left" data-aos-duration="1000" data-aos-easing="ease-in-sine">
        <div class="p-5">
            <h2 class="text-end mb-4 pe-4">Propuesta</h2>
            <p class="text-center">
              Origen es una celebración de nuestras raíces, una propuesta gastronómica inspirada en la riqueza cultural, histórica y natural de nuestra tierra. Cada plato nace de la búsqueda constante de los sabores que nos definen, rescatando ingredientes ancestrales, tradiciones culinarias y conocimientos transmitidos de generación en generación.
            </p>
        </div>
    </div>
    <div class="col-md-6 img-container" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine" id="imgsection">
      <div class="img-box">
        <img src="/img-origen/origen-sec-2.webp" class="img-fluid w-100" alt="Origen Cusco" loading="lazy" width="800" height="533">
      </div>
    </div>
  </div>
</section>

<section class="section container gallery separate-2" id="galeria">
  <div class="section text-center mt-5 mb-5" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
      <h2 class="mb-4 mt-3">Galería</h2> 
    </div>
  </div>
  <div class="p-2 row g-3 gallery">
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="1500"><img src="/img-origen/galeria-origen-1.webp" alt="Galería Origen 1" loading="lazy" width="400" height="300"></div>
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="1500"><img src="/img-origen/galeria-origen-2.webp" alt="Galería Origen 2" loading="lazy" width="400" height="300"></div>
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="1500"><img src="/img-origen/galeria-origen-3.webp" alt="Galería Origen 3" loading="lazy" width="400" height="300"></div>
  </div>
  <div class="p-2 row g-3 gallery">
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="2000"><img src="/img-origen/galeria-origen-4.webp" alt="Galería Origen 4" loading="lazy" width="400" height="300"></div>
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="2000"><img src="/img-origen/galeria-origen-5.webp" alt="Galería Origen 5" loading="lazy" width="400" height="300"></div>
    <div class="col-md-4" data-aos="zoom-in-up" data-aos-duration="2000"><img src="/img-origen/galeria-origen-6.webp" alt="Galería Origen 6" loading="lazy" width="400" height="300"></div>
  </div>
</section>

<section class="container px-0 mt-5">
<p class="text-center">
  <button class="btn-reserva text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
     NUESTRAS EXPERIENCIAS <i class="bi bi-chevron-down"></i>
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body" id="background_experiencias">
    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">01</div>
                <div class="icon-circle"><i class="fas fa-utensils"></i></div>
            </div>
            <div class="col-12 col-md text-center">
                <h5 class="card-title text-center">COOKING CLASS CEVICHE</h5>
            </div>
        </div>
    </div>

    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">02</div>
                <div class="icon-circle"><i class="fas fa-wine-glass-empty"></i></div>
            </div>
            <div class="col-12 col-md text-center">
                <h5 class="card-title text-center">MAKING PISCO SOUR</h5>
            </div>
        </div>
    </div>

    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">03</div>
                <div class="icon-circle"><i class="fas fa-utensils"></i></div>
            </div>
            <div class="col-12 col-md text-center">
                <h5 class="card-title text-center">COOKING CLASS CAUSA</h5>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-12 text-end mt-4">
            <a target="_blank" href="/portafolio-origen/Portafolio_origen.pdf" class="btn btn-warning btn-lg p-3" id="conoce-mas">Conoce más</a>
      </div>
    </div>
  </div>
</div>
<div class="text-center mt-4">
  <button type="button" class="button-cartas pt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
     VER MENÚ
  </button>
</div>
</section>

<section class="section text-center mt-5 mb-5" id="reservas">
  <h2 class="text-center mb-2">Reserva tu experiencia</h2>
  <p class="text-center mb-5">Un viaje gastronómico inolvidable</p>
  <a href="{{route('reservas_comensales')}}" class="btn-reserva">R E S E R V A R</a>
</section>

<section class="section text-center pt-5">
  <img src="/img-origen/iso-origen.webp" class="img-fluid" style="max-width: 200px;" alt="Isotipo Origen" loading="lazy" width="200" height="200">
</section>

<footer class="container-fluid footer-catedral pb-3" id="contactanos">
    <div class="container footer-catedral py-4">
    <div class="row gy-4 mt-3">
        <div class="col-12 col-md-6 text-center text-md-start">
          <h5 class="fw-bold mb-2">ORIGEN {{ now()->year }} ©</h5>
          <p class="mb-3">Contáctanos: <a class="links" target="_blank" href="https://api.whatsapp.com/send?phone=51946452405"> +51 946 452 405</a></p>
          <a href="{{route('reservas_comensales')}}" class="btn-reserva mt-2 mb-4">RESERVA CON NOSOTROS</a>
          <div class="d-flex flex-column gap-2 align-items-center align-items-md-start mt-4">
              <a class="links d-flex align-items-center text-decoration-none text-dark" target="_blank" href="https://www.instagram.com/origen.cusco/">
                  <i class="fa-brands fa-instagram fa-lg me-2"></i>
                  <span>@origen.cusco</span>
              </a>
          </div>
        </div>
        <div class="col-12 col-md-6 d-flex flex-column align-items-center align-self-md-center align-items-md-end">
          <ul class="list-unstyled mb-0">
            <li><i class="fa-solid fa-plus me-2"></i>Libro de Reclamaciones</li>
          </ul>
        </div>
    </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Inicializar animaciones de forma eficiente
    if (typeof AOS !== 'undefined') {
        AOS.init({ once: true });
    }

    // Scroll Navbar optimizado
    const navbar = document.querySelector(".navbar");
    window.addEventListener("scroll", function(){
        navbar.classList.toggle("scrolled", window.scrollY > 50);
    }, { passive: true });

    // Parallax del Hero optimizado con RequestAnimationFrame (Previene lag en móviles)
    let ticking = false;
    const heroBg = document.querySelector(".hero-bg");
    
    window.addEventListener("scroll", function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                if (heroBg) {
                    heroBg.style.transform = `translateY(${window.scrollY * 0.4}px)`;
                }
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
});
</script>
</body>
</html>