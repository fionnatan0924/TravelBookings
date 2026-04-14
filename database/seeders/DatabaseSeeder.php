<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);      // if you have one
        $this->call(FlightsTableSeeder::class);
        $this->call(HotelSeeder::class);
        // Add other seeders as needed
    }
}