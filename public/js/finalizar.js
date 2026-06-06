

    // =========================
    // OBTENER DATOS
    // =========================

    const reservation =
      JSON.parse(
        localStorage.getItem(
          'campoReservation'
        )
      );

    // =========================
    // MOSTRAR DATOS
    // =========================
      
    if(reservation){

      // fecha
    

      document.getElementById(
        'summaryName'
      ).innerText =
        reservation.user || 'Usuario';

      document.getElementById(
        'summaryGuests'
      ).innerText =
        reservation.guests + ' Personas';

      document.getElementById(
        'summaryDate'
      ).innerText =
        reservation.date;

      document.getElementById(
        'summaryHour'
      ).innerText =
        reservation.hour;

      document.getElementById(
        'summaryService'
      ).innerText =
        reservation.service;

      /*// restricciones
      if(
        reservation.preferences &&
        reservation.preferences.foodRestrictions
      ){

        document.getElementById(
          'foodRestrictions'
        ).innerText =
          reservation.preferences.foodDescription;

      }else{

        document.getElementById(
          'foodRow'
        ).style.display = 'none';

      }*/

    };
    const preferences =
      JSON.parse(
        localStorage.getItem('campoPreferences')
      );
    if(preferences){

      // KIDS
      document.getElementById(
        'summaryKids'
      ).innerText =
        preferences.kidsUnder12
        ? preferences.kidsCount
        : 'No';

      // FOOD
      if(
        preferences.foodRestrictions &&
        preferences.foodDescription
      ){

        document.getElementById(
          'foodRestrictionsRow'
        ).style.display = 'flex';

        document.getElementById(
          'summaryRestrictions'
        ).innerText =
          preferences.foodDescription;

      }

    }

    // =========================
    // FINALIZAR
    // =========================

    document
      .getElementById('finishBtn')
      .addEventListener('click', ()=>{       
        // limpiar opcional
        // localStorage.clear();
        localStorage.removeItem('campoService');
        localStorage.removeItem('campoReservation');
        localStorage.removeItem('campoPreferences');
        localStorage.removeItem('campoHour');
        localStorage.removeItem('campoGuests');
        localStorage.removeItem('campoDate');

       window.location.href = "/cliente_dashboard"

        
        

      });

