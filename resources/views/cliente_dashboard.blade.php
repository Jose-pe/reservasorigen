<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Mis Reservas</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/cliente_dashboard.css">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
</head>
<body>

<div class="main-card">

    {{-- HEADER --}}
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
                    <img src="/img/logo-catedral.png" alt="">
                </div>
            </div>
             
                @if (Auth::user()->google_id)
                       <div class="col-3 text-end">
                <form action="{{route('logoutgoogle')}}"  method="post">
                    @csrf
                    
                <button type="submit" class=" justify-content-end">
                    <i class="bi bi-power"></i>
                </button>
            </form></div>
                @endif
                 @if (! Auth::user()->google_id)
                <div class="col-3 text-end">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    
                <button type="submit" class=" justify-content-end">
                    <i class="bi bi-power"></i>
                </button>
            </form></div>
             @endif
            
             
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- TABS --}}
        <div class="custom-tabs">

            <button class="tab-btn active">
                Mis reservas
            </button>

            

        </div>
           {{-- RESERVATION CARD --}}
       @foreach ($reservas as $reserva)
           <div class="reservation-card mt-5">

            {{-- HEADER --}}
            <div
                class="reservation-header"
                id="toggleReservation"
            >

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div
                            class="reservation-title"
                            id="reservationDate"
                        >
                            {{$reserva->reservation_date}} · {{$reserva->reservation_time}}
                        </div>

                        <div
                            class="reservation-subtitle"
                            id="reservationInfo"
                        >
                            {{$reserva->name}} - {{$reserva->guests}} personas - {{$reserva->service}}
                        </div>

                    </div>

                    
                </div>

            </div>

          

            {{-- CANCEL --}}
            <div class="cancel-box">
                 <form action="{{route('reserva_delete', $reserva->id)}}" method="post">
                                @csrf
                <button
                    class="cancel-btn"
                    id="cancelReservation" 
                    type="submit"
                >
                    Cancelar mi reserva
                </button>
                 </form>
            </div>

        </div>
       @endforeach

     
        

    </div>

    {{-- BOTTOM --}}
    <div class="text-center mb-4">

        <a href="{{route('reservas_comensales')}}" class="btn btn-dark btn-lg">

          
           Nueva reserva

        </a>

    </div>

    {{-- FOOTER --}}
    <div class="footer">
        desarrollado por <strong>Jose Luis Corazao</strong>
    </div>

</div>


{{--js--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>