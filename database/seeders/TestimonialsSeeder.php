<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestimonialsSeeder extends Seeder
{
    public function run()
    {
        // Delete old testimonials
        Testimonial::truncate();

        // Create users without email_verified_at
        $users = [
            ['name' => 'John Doe', 'email' => 'john.test@example.com'],
            ['name' => 'Sarah Smith', 'email' => 'sarah.test@example.com'],
            ['name' => 'Michael Brown', 'email' => 'michael.test@example.com'],
            ['name' => 'Emma Wilson', 'email' => 'emma.test@example.com'],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                    // Remove email_verified_at
                ]
            );
        }

        // Testimonials
        $testimonials = [
            [
                'user_index' => 0,
                'content' => 'Travelio made booking my flight so easy! The interface is clean and I found a great deal to Bangkok.',
                'location' => 'Bangkok, Thailand',
            ],
            [
                'user_index' => 1,
                'content' => 'The hotel selection is amazing. I booked a beachfront resort in Bali with just a few clicks. Highly recommended!',
                'location' => 'Bali, Indonesia',
            ],
            [
                'user_index' => 2,
                'content' => 'Great combo deals! Saved over RM 500 on my Tokyo trip. Will use Travelio again.',
                'location' => 'Tokyo, Japan',
            ],
            [
                'user_index' => 3,
                'content' => 'Customer support was very responsive when I needed to change my check‑in date. Stress‑free experience!',
                'location' => 'Paris, France',
            ],
        ];

        foreach ($testimonials as $data) {
            $user = $createdUsers[$data['user_index']];
            Testimonial::create([
                'user_id' => $user->id,
                'content' => $data['content'],
                'location' => $data['location'],
            ]);
        }

        $this->command->info('Testimonials seeded successfully!');
    }
}