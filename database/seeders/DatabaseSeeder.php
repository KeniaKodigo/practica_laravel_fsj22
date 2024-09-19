<?php

namespace Database\Seeders;

use App\Models\Accomodations;
use App\Models\Bookings;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //informacion random
        //creamos 10 registros falsos a la tabla user
        //User::factory(10)->create();

        //creando registros falsos para los alojamientos
        //Accomodations::factory(5)->create();

        //creando regsitros falsos para las reservaciones
        Bookings::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
