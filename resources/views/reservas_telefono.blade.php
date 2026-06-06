<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Completar Registro</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/telefono.css">
    
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Codigos de pais y banderas --> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@29.0.1/dist/css/intlTelInput.css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

 <style>
    .iti {
        width: 100%;
    }

   
</style>
</head>
<body>

  <div>

    <div class="register-card">

      <!-- CONTENT -->
      <div class="card-content">

        <!-- TITLE -->
        <h1 class="title">
          Ya casi
        </h1>

        <p class="subtitle">
          Agregá un teléfono para terminar de crear tu cuenta.
        </p>

        <!-- GOOGLE -->
        <button class="google-btn">

          <img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
            width="20"
          >

          Continuando con Google

        </button>
        <form action="/reservas_fechas" method="GET">
               <!-- NAME -->
        <div class="input-group-custom">

          <i class="bi bi-person input-icon"></i>

          <input
            type="text"
            class="form-control form-control-custom"
            placeholder="{{$nombre_usuario}}"
            id="userName" disabled
          >

        </div>

        <!-- PHONE -->
        <div class="input-group-custom">

           

         {{--<input
            type="numeric"
            oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*)\./g, '$1');" 
            class="form-control form-control-custom"
            placeholder="Ingrese un Celular"
            id="userPhone" required name="telefono"
          >--}}
           <input 
                            type="tel" 
                            id="userPhone"
                            class="form-control form-control-custom"
                            placeholder="Ingrese su teléfono"  required
                        >

        </div>

        <!-- EMAIL -->
        <div class="input-group-custom">

          <i class="bi bi-envelope input-icon"></i>

          <input
            type="email"
            class="form-control form-control-custom"
            placeholder="{{$email_usuario}}"
            id="userEmail" disabled
          >

        </div>

        <!-- CHECK -->
        <div class="custom-check">

          <input
            type="checkbox"
            id="marketingCheck"
          >

          <label for="marketingCheck">

            Acepto que el restaurante me envíe información ocasional sobre eventos especiales o celebraciones.

          </label>

        </div>

        <!-- BUTTON -->
        <button type="submit"
          class="register-btn"
          id="registerBtn"
        >
          Completar registro
        </button>

        </form>
     
       

      </div>

      <!-- FOOTER -->
     

    </div>

    <!-- POWERED -->
    <div class="powered">
      Powered by <strong>Jose Luis Corazao</strong>
    </div>

  </div>
<script src="/js/telefono.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- intl-tel-input -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@29.0.1/dist/js/intlTelInput.min.js"></script>
<script>
   const input = document.getElementById("userPhone");
  const iti = window.intlTelInput(input, {
    separateDialCode: true,
    initialCountry: "pe",
    loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@29.0.1/dist/js/utils.js"),
    
   
  });

   //let userPhone = document.getElementById("userPhone");

        // Obtiene el número en formato internacional limpio (Ej: +34600123456)
     
    
    document.getElementById('registerBtn')
      .addEventListener('click', ()=>{

         let prefijo_pais=document.querySelector('.iti__selected-dial-code').textContent;
    
        let numeroCompleto = prefijo_pais + input.value; 
            
         localStorage.setItem(
          'campoUserPhone',
          numeroCompleto
        );           

      });
      
</script>
</body>
 
</html>