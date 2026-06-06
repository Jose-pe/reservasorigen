<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->role = 'admin') {
            $nombre_usuario = Auth::user()->name;
            $email_usuario = Auth::user()->email;
            $phone_usuario = Auth::user()->phone;
           return redirect()->route('admin_dashboard');

        }else{
            $nombre_usuario = Auth::user()->name;
            $email_usuario = Auth::user()->email;
            $phone_usuario = Auth::user()->phone;
            return redirect()->route('reservas_fechas',compact('nombre_usuario','email_usuario','phone_usuario'));
        }
       
    }
}
