<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Flight;
use App\Models\User;
use App\Models\Attraction;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Traveler',
                'email' => 'traveler@example.com',
                'password' => bcrypt('password')
            ]);
        }

       
        $destinations = [
            ['name' => 'Kuala Lumpur', 'starting_price' => 150, 'color' => '#FF6B6B', 'image_url' => 'https://images.unsplash.com/photo-1590559899731-a382839e5547?w=400&h=300&fit=crop'],
            ['name' => 'Penang', 'starting_price' => 120, 'color' => '#4ECDC4', 'image_url' => 'https://images.unsplash.com/photo-1582228112122-bfda5d1e3d2f?w=400&h=300&fit=crop'],
            ['name' => 'Langkawi', 'starting_price' => 180, 'color' => '#45B7D1', 'image_url' => 'https://images.unsplash.com/photo-1589187163517-1d9adf7a9e1c?w=400&h=300&fit=crop'],
            ['name' => 'Bangkok', 'starting_price' => 200, 'color' => '#96CEB4', 'image_url' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=400&h=300&fit=crop'],
            ['name' => 'Singapore', 'starting_price' => 250, 'color' => '#FFD93D', 'image_url' => 'https://images.unsplash.com/photo-1525625293386-3f2f0b8b1f8f?w=400&h=300&fit=crop'],
            ['name' => 'Bali', 'starting_price' => 899, 'color' => '#E6A57E', 'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=300&fit=crop'],
            ['name' => 'Tokyo', 'starting_price' => 1999, 'color' => '#7AA6C2', 'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=300&fit=crop'],
            ['name' => 'Paris', 'starting_price' => 2599, 'color' => '#BFA5D6', 'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=300&fit=crop'],
            ['name' => 'Hong Kong', 'starting_price' => 1200, 'color' => '#FF9F1C', 'image_url' => 'https://images.unsplash.com/photo-1515847049296-a281d640104e?w=400&h=300&fit=crop'],
            ['name' => 'Maldives', 'starting_price' => 3299, 'color' => '#80C9C3', 'image_url' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=400&h=300&fit=crop'],
            ['name' => 'Johor Bahru', 'starting_price' => 100, 'color' => '#A8E6CF', 'image_url' => 'https://images.unsplash.com/photo-1565967511843-4c4b5f7b6b9c?w=400&h=300&fit=crop'],
            ['name' => 'Guangzhou', 'starting_price' => 800, 'color' => '#FFB347', 'image_url' => 'https://images.unsplash.com/photo-1589578228447-e1a4e481c6b8?w=400&h=300&fit=crop'],
            ['name' => 'Shanghai', 'starting_price' => 1100, 'color' => '#5D9B9B', 'image_url' => 'https://images.unsplash.com/photo-1538428494232-9c0d8c3e1e3f?w=400&h=300&fit=crop'],
            ['name' => 'Chongqing', 'starting_price' => 600, 'color' => '#D4A5A5', 'image_url' => 'https://images.unsplash.com/photo-1589793907316-f94025b46850?w=400&h=300&fit=crop'],
            ['name' => 'Vietnam', 'starting_price' => 350, 'color' => '#9B5DE5', 'image_url' => 'https://images.unsplash.com/photo-1543353071-10c8a85a6c6f?w=400&h=300&fit=crop'],
            ['name' => 'South Korea', 'starting_price' => 1400, 'color' => '#F15BB5', 'image_url' => 'https://images.unsplash.com/photo-1529927268413-80b3cfc9b8e6?w=400&h=300&fit=crop'],
            ['name' => 'Hokkaido', 'starting_price' => 1600, 'color' => '#00BBF9', 'image_url' => 'https://images.unsplash.com/photo-1568043210943-0e5b2b9d6f8c?w=400&h=300&fit=crop'],
            ['name' => 'Chiang Mai', 'starting_price' => 280, 'color' => '#FEE440', 'image_url' => 'https://images.unsplash.com/photo-1528181304809-1f8c6f5b7a1a?w=400&h=300&fit=crop'],
            ['name' => 'Sabah', 'starting_price' => 380, 'color' => '#9C89B8', 'image_url' => 'https://images.unsplash.com/photo-1567968456-9b5f6c5f5b5c?w=400&h=300&fit=crop'],
            ['name' => 'Iceland', 'starting_price' => 2800, 'color' => '#6B8E9B', 'image_url' => 'https://images.unsplash.com/photo-1504893524553-b855cce32c7c?w=400&h=300&fit=crop'],
        ];

        foreach ($destinations as $dest) {
            Destination::updateOrCreate(['name' => $dest['name']], $dest);
        }

        // Get destination IDs
        $bali = Destination::where('name', 'Bali')->first();
        $tokyo = Destination::where('name', 'Tokyo')->first();
        $paris = Destination::where('name', 'Paris')->first();
        $maldives = Destination::where('name', 'Maldives')->first();
        

        // Packages (Combos)
        $packages = [
            ['name' => 'Bali Beach Escape', 'price' => 899, 'duration_days' => 5, 'duration_nights' => 4, 'meal_plan' => 'Breakfast Only', 'type' => 'Relaxation', 'emoji' => '🏖️', 'image_url' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=400&h=250&fit=crop', 'is_featured' => true, 'destination_id' => $bali->id],
            ['name' => 'Tokyo City Explorer', 'price' => 1999, 'duration_days' => 7, 'duration_nights' => 6, 'meal_plan' => 'Breakfast and Dinner', 'type' => 'City Tour', 'emoji' => '🗼', 'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop', 'is_featured' => true, 'destination_id' => $tokyo->id],
            ['name' => 'Paris Romantic Getaway', 'price' => 2599, 'duration_days' => 6, 'duration_nights' => 5, 'meal_plan' => 'All Inclusive', 'type' => 'Romantic', 'emoji' => '❤️', 'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=250&fit=crop', 'is_featured' => false, 'destination_id' => $paris->id],
            ['name' => 'Maldives Luxury Retreat', 'price' => 3299, 'duration_days' => 8, 'duration_nights' => 7, 'meal_plan' => 'All Inclusive', 'type' => 'Luxury', 'emoji' => '🌴', 'image_url' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=400&h=250&fit=crop', 'is_featured' => true, 'destination_id' => $maldives->id],
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(['name' => $pkg['name']], $pkg);
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

        // Flights
        Flight::updateOrCreate(
            ['from' => 'Kuala Lumpur', 'to' => 'Penang', 'departure_date' => '2026-05-01', 'departure_time' => '08:00:00'],
            ['price' => 120.00, 'available_seats' => 50]
        );
        Flight::updateOrCreate(
            ['from' => 'Kuala Lumpur', 'to' => 'Penang', 'departure_date' => '2026-05-01', 'departure_time' => '15:00:00'],
            ['price' => 130.00, 'available_seats' => 60]
        );
        Flight::updateOrCreate(
            ['from' => 'Kuala Lumpur', 'to' => 'Johor Bahru', 'departure_date' => '2026-05-01', 'departure_time' => '09:30:00'],
            ['price' => 150.00, 'available_seats' => 30]
        );
        Flight::updateOrCreate(
            ['from' => 'Penang', 'to' => 'Kuala Lumpur', 'departure_date' => '2026-05-02', 'departure_time' => '14:00:00'],
            ['price' => 110.00, 'available_seats' => 40]
        );
        Flight::updateOrCreate(
            ['from' => 'Kuala Lumpur', 'to' => 'Langkawi', 'departure_date' => '2026-05-03', 'departure_time' => '07:45:00'],
            ['price' => 200.00, 'available_seats' => 20]
        );

        // Attractions
        // Attractions for Bali (Real Data)
            $attractions = [
    // Bali
    [
        'name' => 'Waterbom Bali',
        'destination_id' => $bali->id,
        'rating' => 4.7,
        'reviews' => 17828,
        'price' => 71.00,
        'original_price' => 79.00,
        'discount_text' => '10% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Penida Island',
        'destination_id' => $bali->id,
        'rating' => 4.4,
        'reviews' => 1199,
        'price' => 18.00,
        'original_price' => null,
        'discount_text' => null,
        'booking_text' => 'Immediate access',
        'image_url' => 'https://images.unsplash.com/photo-1543946207-76e51b0b631c?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Ubud Palace',
        'destination_id' => $bali->id,
        'rating' => 4.4,
        'reviews' => 1085,
        'price' => 0.00,
        'original_price' => null,
        'discount_text' => null,
        'booking_text' => 'Free entry',
        'image_url' => 'https://images.unsplash.com/photo-1573461160327-b450ce3d8e7f?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Ayung River Rafting',
        'destination_id' => $bali->id,
        'rating' => 4.6,
        'reviews' => 650,
        'price' => 35.00,
        'original_price' => 45.00,
        'discount_text' => '22% off',
        'booking_text' => 'Book now for today',
        'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    // Tokyo
    [
        'name' => 'Tokyo Disneyland Pass',
        'destination_id' => $tokyo->id,
        'rating' => 9.4,
        'reviews' => 78200,
        'price' => 85.00,
        'original_price' => 110.00,
        'discount_text' => '23% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://images.unsplash.com/photo-1545147961-2a8e8f6b9f5a?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Shibuya Sky Observation',
        'destination_id' => $tokyo->id,
        'rating' => 9.1,
        'reviews' => 45200,
        'price' => 22.00,
        'original_price' => 28.00,
        'discount_text' => '21% off',
        'booking_text' => 'Mobile ticket',
        'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Senso-ji Temple Tour',
        'destination_id' => $tokyo->id,
        'rating' => 8.8,
        'reviews' => 51508,
        'price' => 18.00,
        'original_price' => 25.00,
        'discount_text' => '28% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Tokyo Tower Entry',
        'destination_id' => $tokyo->id,
        'rating' => 8.5,
        'reviews' => 32000,
        'price' => 15.00,
        'original_price' => null,
        'discount_text' => null,
        'booking_text' => 'Immediate access',
        'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    // Paris
    [
        'name' => 'Eiffel Tower Summit Access',
        'destination_id' => $paris->id,
        'rating' => 9.2,
        'reviews' => 120000,
        'price' => 30.00,
        'original_price' => 45.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Louvre Museum Fast Track',
        'destination_id' => $paris->id,
        'rating' => 9.0,
        'reviews' => 85000,
        'price' => 25.00,
        'original_price' => 35.00,
        'discount_text' => '29% off',
        'booking_text' => 'Mobile ticket',
        'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    // Maldives
    [
        'name' => 'Maldives Snorkeling Adventure',
        'destination_id' => $maldives->id,
        'rating' => 9.5,
        'reviews' => 5000,
        'price' => 50.00,
        'original_price' => 70.00,
        'discount_text' => '28% off',
        'booking_text' => 'Book now for today',
        'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop',
        'is_active' => true
    ],
    [
        'name' => 'Maldives Sunset Cruise',
        'destination_id' => $maldives->id,
        'rating' => 9.3,
        'reviews' => 3000,
        'price' => 40.00,
        'original_price' => null,
        'discount_text' => null,
        'booking_text' => 'Immediate access',
        'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop',
        'is_active' => true
    ],
];

        foreach ($attractions as $att) {
            Attraction::updateOrCreate(
                ['name' => $att['name'], 'destination_id' => $att['destination_id']],
                $att
            );
        }
    }
}