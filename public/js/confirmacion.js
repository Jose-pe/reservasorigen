

    // =========================
    // OBTENER DATOS
    // =========================
    let user = document.getElementById(
      'summaryName'
    ).innerText;
    const guests =
      localStorage.getItem('campoGuests');

    const date =
      localStorage.getItem('campoDate');

    const hour =
      localStorage.getItem('campoHour');

    const service =
      localStorage.getItem('campoService');

    /*const userName =
      localStorage.getItem('campoUserName');*/

    const preferences =
      JSON.parse(
        localStorage.getItem('campoPreferences')
      );

    // =========================
    // FORMATEAR FECHA
    /* =========================

    const dateObj =
      new Date(date);

    const formattedDate =
      dateObj.toLocaleDateString(
        'es-ES',
        {
          weekday:'long',
          year:'numeric',
          month:'long',
          day:'numeric'
        }
      );*/

    // =========================
    // TOP PILLS
    // =========================

    document.getElementById(
      'peoplePill'
    ).innerText =
      guests + ' Personas';

    document.getElementById(
      'datePill'
    ).innerText =
      date

    document.getElementById(
      'hourPill'
    ).innerText =
      hour;

    // =========================
    // SUMMARY
    // =========================

    

    document.getElementById(
      'summaryGuests'
    ).innerText =
      guests + ' Personas';

    document.getElementById(
      'summaryDate'
    ).innerText =
      date;

    document.getElementById(
      'summaryHour'
    ).innerText =
      hour;

    document.getElementById(
      'summaryService'
    ).innerText =
      service;

    // =========================
    // PREFERENCIAS
    // =========================

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
    // RESERVAR
    // =========================

    document
      .getElementById('reserveBtn')
      .addEventListener('click', ()=>{

        const reservationData = {
          user,
          guests,
          date,
          hour,
          service,          
          preferences

        };

        localStorage.setItem(
          'campoReservation',
          JSON.stringify(reservationData)
        );

        console.log(
          JSON.parse(
            localStorage.getItem(
              'campoReservation'
            )
          )
        );     

      });

