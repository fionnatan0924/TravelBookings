<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Testimonial;

class HomeSeeder extends Seeder
{
    public function run()
    {
        // Create a default user if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Traveler',
                'email' => 'traveler@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Testimonials
        Testimonial::updateOrCreate(
            ['content' => 'Amazing trip! Everything was perfectly organized.'],
            ['user_id' => $user->id, 'location' => 'Malaysia']
        );
        Testimonial::updateOrCreate(
            ['content' => 'Best travel experience ever!'],
            ['user_id' => $user->id, 'location' => 'Singapore']
        );
        Testimonial::updateOrCreate(
            ['content' => 'Highly recommended travel packages.'],
            ['user_id' => $user->id, 'location' => 'Thailand']
        );
    }
}