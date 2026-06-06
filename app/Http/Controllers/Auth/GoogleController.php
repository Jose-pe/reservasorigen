<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){

    /* try {

        $googleUser = Socialite::driver('google')->user();

        dd($googleUser);

    } catch (\Exception $e) {

        dd($e->getMessage());
    }*/
         //Http::withoutVerifying();
          // $googleUser = Socialite::driver('google')->user();
            $googleUser = Socialite::driver('google')->stateless()->user();
            // Buscar si el usuario ya existe por su correo
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Si existe, loguearlo
                Auth::login($user);
               return redirect()->intended('reservas_telefono');
            } else {
                // Si no existe, crear uno nuevo
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => 'cliente',
                    'password' => bcrypt('123456dummy') // O dejarlo nulo si tu DB lo permite
                ]);
                
                Auth::login($newUser);
            }
            
            return redirect()->intended('reservas_telefono');

       
    }  
    
    
}
