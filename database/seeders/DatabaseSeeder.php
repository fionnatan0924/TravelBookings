<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {    
        $this->call(FlightsTableSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(DestinationsAndAttractionsSeeder::class);
        $this->call(TestimonialsSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}