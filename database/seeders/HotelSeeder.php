<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotels = [
            // Kuala Lumpur (KUL)
            [
                'name' => 'Grand Plaza KLCC',
                'city' => 'KUL',
                'address' => '123 Jalan Ampang, Kuala Lumpur City Centre',
                'price_per_night' => 250,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/104/400/250'  // hotel-like image
            ],
            [
                'name' => 'Budget Inn Bukit Bintang',
                'city' => 'KUL',
                'address' => '45 Jalan Bukit Bintang',
                'price_per_night' => 80,
                'stars' => 2,
                'image' => 'https://picsum.photos/id/164/400/250'
            ],

            // Penang (PEN)
            [
                'name' => 'Seaside Resort Batu Ferringhi',
                'city' => 'PEN',
                'address' => '1 Batu Ferringhi Beach Road',
                'price_per_night' => 180,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/15/400/250'
            ],
            [
                'name' => 'George Town Heritage Hotel',
                'city' => 'PEN',
                'address' => '22 Lebuh Armenian',
                'price_per_night' => 120,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/96/400/250'
            ],

            // Langkawi (LGK)
            [
                'name' => 'Langkawi Lagoon Resort',
                'city' => 'LGK',
                'address' => 'Pantai Cenang, Langkawi',
                'price_per_night' => 200,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/29/400/250'
            ],

            // Bangkok (BKK)
            [
                'name' => 'Bangkok Riverside Hotel',
                'city' => 'BKK',
                'address' => '123 Chao Phraya Road',
                'price_per_night' => 220,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/106/400/250'
            ],
            [
                'name' => 'Sukhumvit Budget Stay',
                'city' => 'BKK',
                'address' => '45 Sukhumvit Soi 11',
                'price_per_night' => 60,
                'stars' => 2,
                'image' => 'https://picsum.photos/id/127/400/250'
            ],

            // Singapore (SIN)
            [
                'name' => 'Marina Bay Sands View Hotel',
                'city' => 'SIN',
                'address' => '10 Bayfront Avenue',
                'price_per_night' => 350,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/128/400/250'
            ],
            [
                'name' => 'Chinatown Boutique Inn',
                'city' => 'SIN',
                'address' => '22 Temple Street',
                'price_per_night' => 110,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/129/400/250'
            ],

            // Bali (DPS)
            [
                'name' => 'Bali Dream Resort',
                'city' => 'DPS',
                'address' => 'Jl. Pantai Kuta, Bali',
                'price_per_night' => 150,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/130/400/250'
            ],

            // Tokyo (NRT)
            [
                'name' => 'Shinjuku Central Hotel',
                'city' => 'NRT',
                'address' => '3-5-7 Shinjuku, Tokyo',
                'price_per_night' => 280,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/131/400/250'
            ],

            // Paris (CDG)
            [
                'name' => 'Eiffel Tower View Hotel',
                'city' => 'CDG',
                'address' => '15 Rue de la Paix, Paris',
                'price_per_night' => 350,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/132/400/250'
            ],

            // Hong Kong (HKG)
            [
                'name' => 'Victoria Harbour Hotel',
                'city' => 'HKG',
                'address' => '1 Harbour Road, Wan Chai',
                'price_per_night' => 270,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/133/400/250'
            ],

            // Maldives (MLE)
            [
                'name' => 'Overwater Bungalow Resort',
                'city' => 'MLE',
                'address' => 'North Male Atoll',
                'price_per_night' => 550,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/134/400/250'
            ],

            // Johor Bahru (JHB)
            [
                'name' => 'JB City Square Hotel',
                'city' => 'JHB',
                'address' => '88 Jalan Wong Ah Fook',
                'price_per_night' => 90,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/135/400/250'
            ],

            // Guangzhou (CAN)
            [
                'name' => 'Canton Tower Hotel',
                'city' => 'CAN',
                'address' => '123 Yuexiu District',
                'price_per_night' => 130,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/136/400/250'
            ],

            // Shanghai (PVG)
            [
                'name' => 'The Bund Riverside Hotel',
                'city' => 'PVG',
                'address' => '20 Zhongshan East Road',
                'price_per_night' => 210,
                'stars' => 5,
                'image' => 'https://picsum.photos/id/137/400/250'
            ],

            // Chongqing (CKG)
            [
                'name' => 'Mountain View Hotel',
                'city' => 'CKG',
                'address' => '45 Jiefangbei Central',
                'price_per_night' => 100,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/138/400/250'
            ],

            // Vietnam – Hanoi (HAN)
            [
                'name' => 'Old Quarter Inn',
                'city' => 'HAN',
                'address' => '12 Hang Bac Street',
                'price_per_night' => 70,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/139/400/250'
            ],

            // South Korea – Seoul (ICN)
            [
                'name' => 'Myeongdong Central Hotel',
                'city' => 'ICN',
                'address' => '55 Myeongdong-gil, Seoul',
                'price_per_night' => 180,
                'stars' => 4,
                'image' => 'https://picsum.photos/id/140/400/250'
            ],

            // Hokkaido (CTS)
            [
                'name' => 'Sapporo Snow Lodge',
                'city' => 'CTS',
                'address' => '10 Kita-jo, Sapporo',
                'price_per_night' => 160,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/141/400/250'
            ],

            // Chiang Mai (CNX)
            [
                'name' => 'Old City Boutique Hotel',
                'city' => 'CNX',
                'address' => '24 Ratchadamnoen Road',
                'price_per_night' => 85,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/142/400/250'
            ],

            // Sabah – Kota Kinabalu (BKI)
            [
                'name' => 'Kinabalu Mountain View Resort',
                'city' => 'BKI',
                'address' => 'Jalan Tun Fuad Stephens',
                'price_per_night' => 120,
                'stars' => 3,
                'image' => 'https://picsum.photos/id/143/400/250'
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}