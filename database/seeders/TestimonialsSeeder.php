<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialsSeeder extends Seeder
{
    public function run()
    {
        $john = User::where('email', 'john@example.com')->first();
        $sarah = User::where('email', 'sarah@example.com')->first();
        $michael = User::where('email', 'michael@example.com')->first();
        $emma = User::where('email', 'emma@example.com')->first();

        if (!$john || !$sarah || !$michael || !$emma) {
            $this->command->error('Sample users not found. Run UsersTableSeeder first.');
            return;
        }

        $testimonials = [
            [
                'user_id' => $john->id,
                'content' => 'Travelio made booking my flight so easy! The interface is clean and I found a great deal to Bangkok.',
                'location' => 'Bangkok, Thailand',
            ],
            [
                'user_id' => $sarah->id,
                'content' => 'The hotel selection is amazing. I booked a beachfront resort in Bali with just a few clicks. Highly recommended!',
                'location' => 'Bali, Indonesia',
            ],
            [
                'user_id' => $michael->id,
                'content' => 'Great combo deals! Saved over RM 500 on my Tokyo trip. Will use Travelio again.',
                'location' => 'Tokyo, Japan',
            ],
            [
                'user_id' => $emma->id,
                'content' => 'Customer support was very responsive when I needed to change my check‑in date. Stress‑free experience!',
                'location' => 'Paris, France',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::firstOrCreate(
                ['content' => $testimonial['content']],
                $testimonial
            );
        }
    }
}