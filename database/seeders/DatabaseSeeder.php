<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);      
        $this->call(FlightsTableSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(DestinationsAndAttractionsSeeder::class);
    }
}