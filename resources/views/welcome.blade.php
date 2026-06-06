<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Catedral Restaurante</title>

  <!-- Bootstrap -->
  <link rel="icon" type="/image/png" href="/img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet"  href="/css/catedral.css">
  <link rel="stylesheet"  href="/css/catedralex.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
</head>
<body>

<!-- NAVBAR -->
<nav class="navbarra navbar-expand-lg navbar-dark fixed-top">
 <div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-3 text-start">
     <i class="fa-solid fa-bars fa-2xl p-2" id="menu-button" onclick="toggleMenu()"></i>
         <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    </div>
   
    <div class="col-6 text-center">
       <a class="navbar-brand fw-bold text-center" href="#"><img class="logo-main" src="img/logo-catedral-blanco.png" alt="Restaurant en Cusco"></a>
    </div>
    <div class="col-3 text-end">
     <div class="dropdown p-2">
  <a class="btn btn-outline-light dropdown-toggle  btn-nav text-light" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
    ES
  </a>
  <ul class="dropdown-menu btn-nav " aria-labelledby="dropdownMenu2">
    <li><a href="/eng" class="dropdown-item text-light" type="button">EN</a></li>
    
  </ul>
</div>
          
          
        
          
    </div>
  </div>
 
 </div>
</nav>
 <div class="sidebar" id="sidebar">
  <span  onclick="toggleMenu()" class=" text-end"><i class="fa-solid fa-xmark fa-2xl fa-x" style="color: rgb(255, 255, 255);"></i></span>
  <a href="#">INICIO</a>
  <a href="{{route('reservas_comensales')}}">RESERVAS</a>
  <a href="#nosotros">NOSOTROS</a>
  <a href="#galeria">GALERÍA</a>
  <a href="#footer">CONTACTO</a>
  <hr>
   <a href="#">GRP. CAMPANAYOC</a>
   <a href="#">IL OLIVO</a>
   <a href="#">ORIGEN</a>
</div>
<!-- HERO -->
<section class="hero d-flex align-items-center text-center">
    
    <div class="container hero-content">
    
    <h1 class=" titulo-main">CATEDRAL</h1>
    <h3 class="lead mb-5 ">CUSCO - PERÚ</h3>
    <a href="{{route('reservas_comensales')}}" class="btn-reserva-main ">RESERVA CON NOSOTROS</a>
  </div>
</section>




<section class="section-morena py-5" id="nosotros">
  <div class="container px-0">
    <div class="row g-0 align-items-center mb-3">

      <!-- IMAGEN -->
      <div class="col-lg-6" data-aos="fade-right">
        <div class="image-wrap">
           <img src="/img/main-catedral.png">
             
        </div>
      </div>

      <!-- CONTENIDO -->
      <div class="col-lg-6 content-wrap" data-aos="fade-up"  data-aos-easing="ease-in-sine" >

        <p class="intro-text">
            En Catedral, cada visita se convierte en una experiencia sensorial y visual
            única. <br>
            Nuestro restaurante está ubicado en una casona cusqueña con vista directa a
            la majestuosa Catedral y su cúpula, lo que brinda un entorno privilegiado para
            disfrutar la ciudad desde otro ángulo: con calma, elegancia y sabor.<br>
            El diseño interior equilibra lo contemporáneo con lo colonial, destacando
            materiales nobles, iluminación cálida y una distribución de espacios que
            permite adaptarse a distintos tipos de experiencias: desde almuerzos al aire
            libre en nuestra terraza, hasta cenas íntimas en salones más reservados o
            momentos relajados en la vinoteca. <br>
            La arquitectura que nos rodea no solo enmarca el restaurante, sino que
            acompaña el servicio: amplio, profesional, cercano y siempre dispuesto a
            cuidar cada detalle.
        </p>

        <div class="info-block">
          <div class="info-row">
            <span>DIRECCIÓN</span>
            <a class="links" target="_blank" href="https://maps.app.goo.gl/RrdEbubsxijqxq5s5">Cuesta Almirante 246 - Plaza de Armas Cusco</a>
          </div>

          <div class="info-row">
            <span>CONTACTO</span>
           <a class="links" target="_blank" href="https://api.whatsapp.com/send?phone=946452405"> +51 946 452 405</a>
          </div>

          <div class="info-row">
            <span>REDES</span>
            <div class="text-end">
                <a  target="_blank" href="https://www.instagram.com/catedral.restaurant">  <i class="fa-brands fa-instagram fa-xl links" style="color: rgb(0, 0, 0);"></i></a>
                <a  target="_blank" href="https://www.facebook.com/profile.php?id=61571550651504"><i class="fa-brands fa-square-facebook fa-xl links" style="color: rgb(0, 0, 0);"></i></a>  
                <a href="https://www.tripadvisor.com.pe/Restaurant_Review-g294314-d32763643-Reviews-Catedral_Restaurante-Cusco_Cusco_Region.html" target="_blank"> <i class="fa fa-tripadvisor fa-xl links" style="color: rgb(0, 0, 0);" aria-hidden="true"></i></a>
            </div>
             
            </div>
        </div>

        <div class="cta">
          {{-- <a  target="_blank" href="/carta/carta_catedral.pdf" class="menu-link fw-bolder">VER MENÚ</a>--}}       
         
        <button type="button" class="button-cartas" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
         VER MENÚ
        </button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" id="background_experiencias">
      <div class="modal-header">
        <h5 class="modal-title fw-bolder" id="staticBackdropLabel" style="font-family: 'zapf', serif; font-weight: 400 !important; color: #CBA468 !important; !important; font-size: 1.5rem;">CARTAS Y MENÚ</h5>
        <button type="button" class="btn-close" style="background-color: rgba(255, 255, 255, 0.541) !important;" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <a  target="_blank" href="/carta/carta_catedral.pdf" class="menu-link "> <i class="fas fa-utensils"></i> VER CARTA DE MENÚ </a>  <br><br>
        <a  target="_blank" href="/carta/carta_catedral_postres.pdf" class="menu-link "> <i class="bi bi-cake2-fill"></i> VER CARTA DE POSTRES</a><br><br>
        <a  target="_blank" href="/carta/carta_catedral_vinos.pdf" class="menu-link ">  <i class="fas fa-wine-glass-empty"></i> VER CARTA DE VINOS</a><br><br>
        <a  target="_blank" href="/carta/carta_bar_catedral.pdf" class="menu-link "> <i class="fas fa-wine-bottle"></i> VER CARTA DE BAR</a><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn p-3 bt-lg" id="btn-mas" data-bs-dismiss="modal" aria-label="Close">C E R R A R</button>        
         
      </div>
    </div>
  </div>
</div>
          <a href="{{route('reservas_comensales')}}" class="btn-reserva">RESERVA CON NOSOTROS</a>
        </div>

      </div>

    </div>
  </div>
  <section id="galeria" class="section">
  <div class="container mt-5">
    
    <div class="row g-3 gallery">
      <div class="col-md-4 hover13" data-aos="fade-up" data-aos-duration="500"><img src="img/catedral-galeria1.png"></div>
      <div class="col-md-4 hover13" data-aos="fade-up" data-aos-duration="700"><img src="img/catedral-galeria2.png"></div>
      <div class="col-md-4 hover13" data-aos="fade-up" data-aos-duration="900"><img src="img/catedral-galeria3.png"></div>
    </div>
  </div>
</section>

<section class="container  px-0 mt-5">
<p class="text-center">
  <button class="btn-moderno mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  E X P E R I E N C I A S
 
   <i class="bi bi-chevron-down"></i>
</button>
 
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body" id="background_experiencias">
   <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">01</div>
               <div class="icon-circle">
                    <i class="fas fa-utensils"></i>
                </div>
            </div>
            <div class="col-12 col-md">
                <h5 class="card-title text-uppercase">COOCKING CLASS</h5>
               
            </div>
        </div>
    </div>

    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">02</div>
                <div class="icon-circle">
                    <i class="fas fa-wine-bottle"></i>
                </div>
            </div>
            <div class="col-12 col-md">
                <h5 class="card-title">PISCO MAKING</h5>
                <div class="row g-2">           
               
                </div>
            </div>
        </div>
    </div>

    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">03</div>
                <div class="icon-circle">
                    <i class="fas fa-wine-glass-empty"></i>
                </div>
            </div>
            <div class="col-12 col-md">
                <h5 class="card-title">WINE ROOM</h5>
                
            </div>
        </div>
    </div>

   
    <div class="experience-card">
        <div class="row align-items-center">
            <div class="col-12 col-md-auto d-flex align-items-center mb-3 mb-md-0 card-header-mobile">
                <div class="number-display">04</div>
                <div class="icon-circle">
                    <i class="bi bi-briefcase"></i>
                </div>
            </div>
            <div class="col-12 col-md text-center">
                <h5 class="card-title text-uppercase">Eventos Corporativos</h5>
               
            </div>
        </div>
    </div>
    
     <div class="col-12 col-md-auto text-end mb-3 mb-md-0 card-header-mobile">
    <a href="/carta/portafolio_catedral.pdf" target="_blank"  type="button" class="btn btn-warning btn-lg p-3" id="btn-mas">Conoce más</a>
  </div>  
  </div>
    </div>
    

</div>
  </div>
</div>
</section>






<div class="container px-0 mt-5">
    <div class="row g-0 align-items-center mb-1" id="balcon">
     
         <div class="col-lg-6" data-aos="fade-right">
        <div class="image-wrap">
           <img src="/img/catedral-balcon.png">
             
        </div>
      </div>
      <!-- CONTENIDO -->
      <div class="col-lg-6  content-wrap" data-aos="fade-up"  data-aos-easing="ease-in-sine" >
        <h2 class="mb-5"> BALCÓN CATEDRAL </h2>
        <p class="intro-text">
          La arquitectura que nos rodea no solo enmarca el restaurante, sino que
          acompaña el servicio: amplio, profesional, cercano y siempre dispuesto a
          cuidar cada detalle.
          <br><br>
          La experiencia en Catedral no se limita al plato, sino que se extiende a la vista,
          al ambiente, al ritmo pausado de un buen vino servido en el momento justo, y a
          la atención que hace sentir a cada cliente como en casa, pero mejor.
        </p>         
      </div>
        

    </div>

      <div class="row  g-0  align-items-center">     
      
      <!-- CONTENIDO -->
      
      
      <div class="col-lg-6  content-wrap mb-5" data-aos="fade-up"  data-aos-easing="ease-in-sine" >
        <h2 class="mb-5"> TERRAZA CATEDRAL </h2>
        <p class="intro-text">
         La terraza de Catedral Cusco ofrece una vista privilegiada de las cúpulas y la arquitectura más emblemática de la ciudad, creando un ambiente sofisticado, cálido y perfecto para disfrutar cada detalle. <br>
         <br>
         Entre cócteles, buena gastronomía y una atmósfera única, cada visita se convierte en una experiencia pensada para disfrutar Cusco desde otra perspectiva.
        </p>         
      </div>

         <div class="col-lg-6" data-aos="fade-right">
        <div class="image-wrap">
           <img src="/img/terraza-catedral.png">
             
        </div>
      </div>
        

    </div>
  </div>


 <div class="container px-0 mt-5">  
    <div class="row g-0 align-items-center">  

      <!-- CONTENIDO -->
      <div class="col-lg-6 content-wrap" data-aos="fade-up"  data-aos-easing="ease-in-sine" >
        <h2 class="mb-4">WINE ROOM CATEDRAL</h2>
        <p class="intro-text">
          El Wine Room de Catedral Cusco es un espacio diseñado para vivir una experiencia alrededor del vino en un ambiente elegante e íntimo. <br><br>
         Nuestra cava reúne una cuidada selección de etiquetas nacionales e internacionales, acompañadas por la asesoría personalizada de nuestro sommelier, quien guía cada elección para lograr el maridaje perfecto.
            
        </p>
         <div class="image-wrap pt-1">
           <img src="/img/catedral-sec-3-1.png">
             
        </div>
      

      
      </div>
         <div class="col-lg-6" data-aos="fade-right">
        <div class="image-wrap">
           <img src="/img/catedral-sec-3.png">
             
        </div>
      </div>

    </div>
  </div>
  <div class="container mt-5">
     <div class="row justify-content-end">
     <div class="col-12 d-flex flex-column align-self-center" data-aos="fade-right">
       
           <img src="/img/catedral-sec-4.png">
     
      </div>
  </div>

  </div>
   <div class="container mt-5">
     <div class="row justify-content-end">
     <div class="col-12 d-flex flex-column align-self-center" data-aos="fade-right">
        <p class="out-text"> En Catedral Cusco la arquitectura, la historia y el diseño se integran para crear una experiencia única en el corazón de Cusco. 
        <p class="out-text"> Cada detalle ha sido pensado para resaltar la esencia de la ciudad, combinando elegancia, identidad y una atmósfera sofisticada que invita a disfrutar cada momento en un entorno verdaderamente memorable.</p>
</p>
          
      </div>
  </div>

  </div>
</section>
</section>








<!-- CONTACTO -->


<!-- FOOTER -->
<footer class="container-fluid  footer-catedral pb-4" id="footer">
    <div class="container footer-catedral py-4">
    <div class="row gy-4 mt-3">

    <!-- COLUMNA IZQUIERDA -->
    <div class="col-12 col-md-6 text-center text-md-start">
      <h5 class="fw-bold mb-2">CATEDRAL {{ date('Y') }} ©</h5>
      <p class="mb-2">Contáctanos: <a class="links" target="_blank" href="https://api.whatsapp.com/send?phone=51946452405"> +51 946 452 405</a></p>

      <a href="{{route('reservas_comensales')}}" class="btn-reserva">
        RESERVA CON NOSOTROS
      </a>
    
      <!-- Redes -->
      <div class=" mt-3 d-flex flex-column gap-2 align-items-center align-items-md-start">
        
       <a class="links d-flex align-items-center text-decoration-none text-dark" target="_blank" href="https://www.instagram.com/catedral.restaurant">
          <i class="fa-brands fa-instagram fa-lg me-2"></i>
          <span>@catedral.restaurant</span>
        </a>

      </div>
    </div>

    <!-- COLUMNA DERECHA -->
     <div class="col-12 col-md-6 d-flex flex-column align-items-center align-self-md-center align-items-md-end">
      <ul class="list-unstyled mb-0">
        <li>
          <i class="fa-solid fa-plus me-2"></i>
          Libro de Reclamaciones
        </li>
        
      </ul>
    </div>

  </div>

  <!-- Línea inferior -->
 
    </div>
  
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="/js/main.js"></script>
<script>
  // Navbar cambia al hacer scroll
  window.addEventListener("scroll", function() {
    document.querySelector(".navbarra").classList.toggle("scrolled", window.scrollY > 50);
     
  });

   function toggleMenu() {
    document.getElementById("sidebar").classList.toggle("active");
    document.getElementById("overlay").classList.toggle("active");
  }

 
   AOS.init();
</script>

</body>
</html>