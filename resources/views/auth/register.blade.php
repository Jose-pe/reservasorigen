<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Registrarse</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/telefono.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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

 

    <div class="register-card">

      <!-- CONTENT -->
      <div class="card-content">

        <!-- TITLE -->
        <h1 class="title">
          Registrate
        </h1>

        <form  method="POST" action="{{ route('register') }}">
             @csrf
              <div class="input-group-custom">

          <i class="bi bi-person input-icon"></i>

          <input id="name" type="text" class="form-control form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre de usuario">
         
             @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>

             <div class="input-group-custom">

          <i class="bi bi-envelope input-icon"></i>
             <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese su e-mail">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        

        </div>

          <div class="input-group-custom">

          

         {{-- <input
            type="numeric"
            oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*)\./g, '$1');" 
            class="form-control form-control-custom"
            placeholder="Telefono con codigo de pais +51 912 345 678"
            id="Phone" name="phone"
          > --}}

           <input 
                            type="tel" 
                            id="phone"
                            name="phone"
                            class="form-control form-control-custom"
                            placeholder="Ingrese su teléfono" required
                        >

        </div>

        
          <div class="input-group-custom">
             <i class="bi bi-key input-icon"></i>
         <input id="password" type="password" placeholder="Ingrese una contraseña" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

          </div>    
          
           <div class="input-group-custom">
             <i class="bi bi-key input-icon"></i>
            <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="form-control form-control-custom" name="password_confirmation" required autocomplete="new-password">

           </div>

            <button
          class="register-btn"
          id="registerBtn" type="submit"
        >
          Completar registro
        </button>
        </form>
     <div class="powered">
      Powered by <strong>Jose Luis Corazao</strong>
    </div>
      </div>
    </div>

      <!-- FOOTER -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- intl-tel-input -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@29.0.1/dist/js/intlTelInput.min.js"></script>
<script>
  let input = document.getElementById("phone");
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
        input.value = numeroCompleto;
       // let googleUserPhone = localStorage.getItem('campoUserPhone');
        localStorage.setItem('mailUserPhone', numeroCompleto);
        

      });
      
</script>
 
    

</body>
</html>







