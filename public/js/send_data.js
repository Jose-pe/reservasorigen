// =========================
// ENVIAR RESERVA A LARAVEL
// =========================
 let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
 
 let mailUserPhone = localStorage.getItem('mailUserPhone');
 let googleUserPhone = localStorage.getItem('campoUserPhone');
document
  .getElementById('reserveBtn')
  .addEventListener('click', async ()=>{

    // =========================
    // OBTENER DATOS
    // =========================

    const guests =
      localStorage.getItem('campoGuests');

     let phone;

      if (mailUserPhone !== "") {
        phone = mailUserPhone;
      } else if (googleUserPhone !== "") {
        phone = googleUserPhone;
      } else {
        phone = mailGooglePhone;
      }


         

      const dateOriginal = localStorage.getItem('campoDate');


  let dateFormatted = null;

if (dateOriginal) {
    // 1. Separamos el día, mes y año usando las barras "/"
    const [dia, mes, ano] = dateOriginal.split('/');

    // 2. Nos aseguramos de que el mes y el día tengan siempre 2 dígitos (ej. "5" pasa a "05")
    const mm = mes.padStart(2, '0');
    const dd = dia.padStart(2, '0');

    // 3. Los unimos en el orden que necesitas: YYYY/MM/DD
    dateFormatted = `${ano}/${mm}/${dd}`;
}


    const hour =
      localStorage.getItem('campoHour');

    const service =
      localStorage.getItem('campoService');

   
   

    const preferences =
      JSON.parse(
        localStorage.getItem(
          'campoPreferences'
        )
      );

    // =========================
    // PAYLOAD
    // =========================

    const reservationData = {

      phone : phone,

      guests: Number(guests),

      reservation_date: dateFormatted,

      reservation_time: hour,

      service: service,

      food_restrictions:
        preferences?.foodRestrictions || false,

      food_description:
        preferences?.foodDescription || null,

      kids_under_12:
        preferences?.kidsUnder12 || false,

      kids_count:
        preferences?.kidsCount || 0

    };

    console.log(
      'Datos enviados:',
      reservationData
    );

    // =========================
    // ENVIAR A LARAVEL
    // =========================

    try{

      const response =
        await fetch(
          '/guardar_reserva',
          {
            method:'POST',
            credentials: "same-origin",
            headers:{
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-Whith": "XMLHttpRequest",
              "X-CSRF-TOKEN": token,
            },

            body: JSON.stringify(
              reservationData
            )
          }
        );

      const result =
        await response.json();

      console.log(result);

      // =========================
      // SUCCESS
      // =========================

      if(response.ok){
               // limpiar localstorage opcional
         //localStorage.clear();
        reserveBtn.disabled = true;
        // redireccionar
        window.location.href = "/finalizar_reserva";
        
       /* // Usamos el helper de Blade para generar la URL exacta de la ruta
        const response_logout = await fetch('/logoutgoogle', {
            method: 'POST',
            credentials: "same-origin",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                 "X-Requested-Whith": "XMLHttpRequest",
                'X-CSRF-TOKEN': token
            }
        });*/

        /*if (response_logout.ok) {
            // Redirige a la página de inicio o login tras el éxito
            window.location.href = "/finalizar_reserva";
           
        } else {
            alert('Error al cerrar sesión. Inténtalo de nuevo.');
            
        }*/



        
       

      }else{

        window.location.href = "/reservas_error";
        reserveBtn.disabled = false;
      }

    }catch(error){

      console.error(error);

      window.location.href = "/reservas_error";

    }

  });