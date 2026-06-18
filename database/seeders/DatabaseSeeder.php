<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

       User::create([
            'name' => 'Admin_Reservas',
            'email' => 'admin@origen.com',
            'role' => 'admin',
            'password' => Hash::make('pass-origen-01'),
        ]);

     /*   User::create([
            'name' => 'Reservas_General',
            'email' => 'reservas@campanayoc.com',
            'role' => 'admin',
            'password' => Hash::make('reservas-campanayoc-081'),
        ]);

         User::create([
            'name' => 'Comercial_General',
            'email' => 'comercial@campanayoc.com',
            'role' => 'admin',
            'password' => Hash::make('comercial-campanayoc-079'),
        ]);*/


    }
}
