<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // database/seeders/HotelSeeder.php
public function run() {
    \App\Models\Hotel::create(['name' => 'Grand Plaza', 'city' => 'Kuala Lumpur', 'address' => '123 Main St', 'price_per_night' => 250, 'stars' => 5]);
    \App\Models\Hotel::create(['name' => 'Seaside Resort', 'city' => 'Penang', 'address' => 'Beach Road', 'price_per_night' => 180, 'stars' => 4]);
}
}
