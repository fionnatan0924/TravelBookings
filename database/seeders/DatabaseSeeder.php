<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Flight;
use App\Models\User;
use App\Models\Attraction;
use Database\Seeders\DestinationsAndAttractionsSeeder;

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

        $this->call(DestinationsAndAttractionsSeeder::class);

        // Get destination IDs
        $bali = Destination::where('name', 'Bali')->first();
        $tokyo = Destination::where('name', 'Tokyo')->first();
        $paris = Destination::where('name', 'Paris')->first();
        $maldives = Destination::where('name', 'Maldives')->first();
        $penang = Destination::where('name', 'Penang')->first();
        $langkawi = Destination::where('name', 'Langkawi')->first();
        $bangkok = Destination::where('name', 'Bangkok')->first();
        $singapore = Destination::where('name', 'Singapore')->first();
        $hongkong = Destination::where('name', 'Hong Kong')->first();
        $kualalumpur = Destination::where('name', 'Kuala Lumpur')->first();
        $johorbahru = Destination::where('name', 'Johor Bahru')->first();
        $guangzhou = Destination::where('name', 'Guangzhou')->first();
        $shanghai = Destination::where('name', 'Shanghai')->first();
        $chongqing = Destination::where('name', 'Chongqing')->first();
        $southkorea = Destination::where('name', 'South Korea')->first();
        $hokkaido = Destination::where('name', 'Hokkaido')->first();
        $chiangmai = Destination::where('name', 'Chiang Mai')->first();
        $sabah = Destination::where('name', 'Sabah')->first();
        $iceland = Destination::where('name', 'Iceland')->first();
        

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

        // Duplicate attractions seed block is disabled because we already seed attractions via DestinationsAndAttractionsSeeder.
        return;

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
        'description' => 'Experience the ultimate water park adventure at Waterbom Bali! With thrilling slides, wave pools, and lazy rivers, this tropical paradise offers fun for the whole family. Perfect for beating the heat and enjoying water sports in a lush tropical setting.',
        'image_url' => 'https://www.bushwalkingblog.com.au/wp-content/uploads/2019/09/waterbom-bali.jpg',
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
        'description' => 'Discover the hidden gem of Penida Island with its dramatic cliffs, pristine beaches, and crystal-clear waters. Enjoy snorkeling, swimming, and breathtaking views of the Bali Strait. Perfect for adventure seekers and nature lovers.',
        'image_url' => 'https://cdn.sanity.io/images/nxpteyfv/goguides/d3e2eaa78fd09fb627fc73a574aab803cc203296-1600x1066.jpg',
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
        'description' => 'Visit the stunning Ubud Palace (Puri Saren Agung), home of the Ubud Royal Family. Marvel at traditional Balinese architecture, intricate carvings, and lush courtyard gardens. A cultural must-visit in the heart of Ubud.',
        'image_url' => 'https://www.bondingexplorers.com/wp-content/uploads/2025/07/mina-main.jpg',
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
        'description' => 'Experience thrilling white-water rafting on the sacred Ayung River! Navigate through tropical jungle, dramatic gorges, and exciting rapids while enjoying the stunning surrounding landscape of Bali.',
        'image_url' => 'https://asiantrails.b-cdn.net/wp-content/uploads/2021/03/rafting-1600x900-1.jpg',
        'is_active' => true
    ],
    // Tokyo
    [
        'name' => 'Tokyo Disneyland',
        'destination_id' => $tokyo->id,
        'rating' => 9.4,
        'reviews' => 78200,
        'price' => 85.00,
        'original_price' => 110.00,
        'discount_text' => '23% off',
        'booking_text' => 'Skip the line',
        'description' => 'Step into a magical world at Tokyo Disneyland! Experience iconic attractions, enchanting shows, and delicious Disney-themed cuisine. Perfect for families and Disney fans of all ages.',
        'image_url' => 'https://cdn.cheapoguides.com/wp-content/uploads/sites/2/2022/10/tokyo-disneyland-castle_klook-1024x600.jpg',
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
        'description' => 'Capture breathtaking 360-degree views of Tokyo from the 46th-floor observation deck at Shibuya Sky! Enjoy day and night views of the sprawling city from this modern architectural marvel.',
        'image_url' => 'https://nightscape.tokyo/en/wp-content/uploads/2023/01/shibuya-sky-1.jpg',
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
        'description' => 'Visit Tokyo\'s oldest temple, Senso-ji, founded in 645 AD. Experience traditional Japanese spirituality, explore the vibrant Nakamise shopping street, and immerse yourself in authentic Asakusa culture.',
        'image_url' => 'https://www.japan-guide.com/g18/3001_01.jpg',
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
        'description' => 'Ascend the iconic Tokyo Tower, a 333-meter red lattice structure offering stunning panoramic views of Tokyo City. A symbol of Tokyo\'s post-war recovery and architectural achievement.',
        'image_url' => 'https://www.pelago.com/img/products/JP-Japan/tokyo-tower-observatory-entry-tickets/0405-0238_tokyo-tower-observatory-entry-tickets-japan-pelago0-xlarge.jpg',
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
        'description' => 'Experience the iconic Eiffel Tower from the summit! Enjoy unparalleled views of Paris, the Seine River, and the surrounding countryside. This is the most visited paid monument in the world.',
        'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/12/41/5c/8d.jpg',
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
        'description' => 'Discover the world\'s largest art museum and home to the Mona Lisa! The Louvre houses ancient Egyptian artifacts, Renaissance masterpieces, and contemporary works spanning thousands of years of art history.',
        'image_url' => 'https://assets.travelloapp.com/uploads/deal/e7a29abe7cbda9452528c3fe6323770692c01ac71d4420266218601eb5c744a0.jpg',
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
        'image_url' => 'https://dth.travel/wp-content/uploads/2023/10/Happy-family-girl-in-snorkeling-mask-dive-underwater-with-tropical-fishes-in-coral-reef-sea-pool.-Travel-lifestyle-water-sport-outdoor-adventure_shutterstock_648353362-scaled.jpg',
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
        'image_url' => 'https://www.lilybeachmaldives.com/wp-content/uploads/2018/08/dolphin-sunset-cruise.jpg',
        'is_active' => true
    ],
    //Penang
    [
        'name' => 'George Town Street Art Tour',
        'destination_id' => $penang->id,
        'rating' => 4.6,
        'reviews' => 5421,
        'price' => 25.00,
        'original_price' => 30.00,
        'discount_text' => '17% off',
        'booking_text' => 'Book today',
        'image_url' => 'https://www.toptravelsights.com/wp-content/uploads/2020/05/Penang-Street-Art-6.jpg',
        'is_active' => true
    ],
    [
                'name' => 'Penang Hill Funicular',
                'destination_id' => $penang->id,
                'rating' => 4.5,
                'reviews' => 3200,
                'price' => 10.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Immediate access',
                'image_url' => 'https://res.klook.com/images/w_1200,h_630,c_fill,q_65/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ifgx0tnarl0ybpnltcxb/PenangHillFunicularRailwayTicket(ForNon-MalaysianOnly)-KlookUnitedStates.jpg',
                'is_active' => true
        ],
        [
                'name' => 'Penang Botanic Gardens',
                'destination_id' => $penang->id,
                'rating' => 4.4,
                'reviews' => 2100,
                'price' => 5.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Free entry',
                'image_url' => 'https://cdn.forevervacation.com/uploads/attraction/penang-botanic-gardens-4928.jpg',
                'is_active' => true
        ],
        [
                'name' => 'Penang Street Food Tour',
                'destination_id' => $penang->id,
                'rating' => 4.7,
                'reviews' => 4500,
                'price' => 30.00,
                'original_price' => 40.00,
                'discount_text' => '25% off',
                'booking_text' => 'Book now for tomorrow',
                'image_url' => 'https://www.pelago.com/img/products/MY-Malaysia/penang-street-food-in-georgetown-and-history-walking-audio-tour/8dabaace-a0f6-46b6-912e-768bca9c3c08_penang-street-food-in-georgetown-and-history-walking-audio-tour-xlarge.jpg',
                'is_active' => true
    ],
    //Langkawi
    [
        'name' => 'Langkawi Sky Bridge',
        'destination_id' => $langkawi->id,
        'rating' => 4.8,
        'reviews' => 15000,
        'price' => 15.00,
        'original_price' => 20.00,
        'discount_text' => '25% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/12/6e/cf/28.jpg',
        'is_active' => true
    ],
    [
        'name' => 'Island Hopping Tour',
        'destination_id' => $langkawi->id,
        'rating' => 4.6,
        'reviews' => 6543,
        'price' => 60.00,
        'original_price' => 75.00,
        'discount_text' => '20% off',
        'booking_text' => 'Limited availability',
        'image_url' => 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_720/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/oeip0notjbakgq9khtcu/LangkawiIslandHoppingSharedSpeedboatTour.jpg',
        'is_active' => true
    ],
    // Bangkok
    [
        'name' => 'Grand Palace Tour',
        'destination_id' => $bangkok->id,
        'rating' => 4.8,
        'reviews' => 20000,
        'price' => 80.00,
        'original_price' => 95.00,
        'discount_text' => '17% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit800600gsm/eventThirdParty/2022/05/05/9c07d176-6a89-436b-898a-c64590a49c2f-1651714938547-74b8b6a4166c761426c84dfd69e1751a.jpg',
        'is_active' => true
    ],
       [
            'name' => 'River Cruise Dinner',
            'destination_id' => $bangkok->id,
            'rating' => 4.9,
            'reviews' => 5000,
            'price' => 40.00,
            'original_price' => 50.00,
            'discount_text' => '20% off',
            'booking_text' => 'Book now for today',
            'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/07/70/4a/ad.jpg',
            'is_active' => true
        ],
    // Singapore
    [
        'name' => 'Gardens by the Bay',
        'destination_id' => $singapore->id,
        'rating' => 4.7,
        'reviews' => 25000,
        'price' => 20.00,
        'original_price' => 28.00,
        'discount_text' => '29% off',
        'booking_text' => 'Mobile ticket',
        'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/0d/Marina_Bay_Sands_from_Gardens_By_The_Bay.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Universal Studios Singapore',
            'destination_id' => $singapore->id,
            'rating' => 9.1,
            'reviews' => 18000,
            'price' => 280.00,
            'original_price' => 320.00,
            'discount_text' => '12% off',
            'booking_text' => 'Book now for tomorrow',
            'image_url' => 'https://d2mgzmtdeipcjp.cloudfront.net/files/magazine/2025/02/02/17384898052455.jpg',
            'is_active' => true
        ],
        [
                'name' => 'Singapore Flyer',
                'destination_id' => $singapore->id,
                'rating' => 4.5,
                'reviews' => 15000,
                'price' => 30.00,
                'original_price' => 40.00,
                'discount_text' => '25% off',
                'booking_text' => 'Book now for today',
                'image_url' => 'https://www.pelago.com/img/collections/singapore-flyer/0712-0705_singapore-flyer.jpg',
                'is_active' => true
            ],
    //Hong Kong
    [
        'name' => 'Victoria Peak Tram',
        'destination_id' => $hongkong->id,
        'rating' => 4.6,
        'reviews' => 22000,
        'price' => 10.00,
        'original_price' => 15.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ifm3ngwvqoxifp49etyf.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Star Ferry Ride',
            'destination_id' => $hongkong->id,
            'rating' => 4.7,
            'reviews' => 18000,
            'price' => 5.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/crxhfc2h6yzo5npu065l.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Hong Kong Disneyland',
                'destination_id' => $hongkong->id,
                'rating' => 9.0,
                'reviews' => 30000,
                'price' => 80.00,
                'original_price' => 100.00,
                'discount_text' => '20% off',
                'booking_text' => 'Book now for tomorrow',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Hong_Kong_Disneyland_Castle.jpg/1280px-Hong_Kong_Disneyland_Castle.jpg',
                'is_active' => true
    ],
    // Kuala Lumpur
    [
        'name' => 'Petronas Twin Towers',
        'destination_id' => $kualalumpur->id,
        'rating' => 4.7,
        'reviews' => 30000,
        'price' => 20.00,
        'original_price' => 30.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/0b/1a/85/e4.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Batu Caves Tour',
            'destination_id' => $kualalumpur->id,
            'rating' => 4.5,
            'reviews' => 15000,
            'price' => 10.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/pd7oxi6yz21dwtql57bp.jpg',
            'is_active' => true
        ],
     [
                'name' => 'KL Tower Observation Deck',
                'destination_id' => $kualalumpur->id,
                'rating' => 4.6,
                'reviews' => 20000,
                'price' => 15.00,
                'original_price' => 25.00,
                'discount_text' => '40% off',
                'booking_text' => 'Book now for tomorrow',
                'image_url' => 'https://www.discoverasr.com/content/dam/tal/media/images/destinations/malaysia/Malaysia-City.jpg',
                'is_active' => true
    ],
    // Johor Bahru
    [
        'name' => 'Legoland Malaysia',
        'destination_id' => $johorbahru->id,
        'rating' => 4.5,
        'reviews' => 25000,
        'price' => 50.00,
        'original_price' => 70.00,
        'discount_text' => '28% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://www.kkday.com/en/blog/wp-content/uploads/featured_legoland.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Hello Kitty Town',
            'destination_id' => $johorbahru->id,
            'rating' => 4.3,
            'reviews' => 15000,
            'price' => 30.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/07/02/27/2e.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Johor Bahru City Tour',
                'destination_id' => $johorbahru->id,
                'rating' => 4.0,
                'reviews' => 5000,
                'price' => 20.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Book now for today',
                'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/09/20/09/f2.jpg',
                'is_active' => true
    ],
    //GuangZhou
    [
        'name' => 'Canton Tower Entry',
        'destination_id' => $guangzhou->id,
        'rating' => 4.5,
        'reviews' => 20000,
        'price' => 15.00,
        'original_price' => 25.00,
        'discount_text' => '40% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://www.chinadiscovery.com/assets/images/travel-guide/guangzhou/canton-tower/canton-tower-768-7.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Shamian Island Tour',
            'destination_id' => $guangzhou->id,
            'rating' => 4.4,
            'reviews' => 15000,
            'price' => 10.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://www.thechinaguide.com/uploads/201806/23/5b2e295c4e173.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Guangzhou Opera House',
                'destination_id' => $guangzhou->id,
                'rating' => 4.6,
                'reviews' => 5000,
                'price' => 20.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Book now for today',
                'image_url' => 'https://www.webuildvalue.com/wp-content/uploads/2020/12/Guangzhou-Opera-House-night-landscape.jpg',
                'is_active' => true
    ],
    //Shanghai
    [
        'name' => 'Shanghai Tower Observation Deck',
        'destination_id' => $shanghai->id,
        'rating' => 4.7,
        'reviews' => 25000,
        'price' => 20.00,
        'original_price' => 30.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/e0/c2/c7.jpg',
        'is_active' => true
    ],
     [
            'name' => 'The Bund River Cruise',
            'destination_id' => $shanghai->id,
            'rating' => 4.5,
            'reviews' => 15000,
            'price' => 15.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://asiantrails.b-cdn.net/wp-content/uploads/2021/11/china-shanghai-river-cruise-city-lights.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Yu Garden Entry',
                'destination_id' => $shanghai->id,
                'rating' => 4.6,
                'reviews' => 20000,
                'price' => 10.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Book now for today',
                'image_url' => 'https://ltl-shanghai.com/wp-content/sites/12/2023/03/garden_optimized-1280x720.jpg',
                'is_active' => true
    ],
    //ChongQing
    [
        'name' => 'Chongqing Cable Car',
        'destination_id' => $chongqing->id,
        'rating' => 4.5,
        'reviews' => 20000,
        'price' => 10.00,
        'original_price' => 15.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://www.topchinatravel.com/pic/city/chongqing/attrations/changjiang-ropeway-2.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Dazu Rock Carvings Tour',
            'destination_id' => $chongqing->id,
            'rating' => 4.4,
            'reviews' => 15000,
            'price' => 20.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/07/af/8b/38.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Chongqing Zoo Panda Exhibit',
                'destination_id' => $chongqing->id,
                'rating' => 4.6,
                'reviews' => 5000,
                'price' => 15.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Book now for today',
                'image_url' => 'https://www.chinadiscovery.com/assets/images/travel-guide/chongqing/chongqing-zoo/pandas-in-chongqing-banner.jpg',
                'is_active' => true
    ],
    // South Korea
    [
        'name' => 'Gyeongbokgung Palace Tour',
        'destination_id' => $southkorea->id,
        'rating' => 4.7,
        'reviews' => 25000,
        'price' => 20.00,
        'original_price' => 30.00,
        'discount_text' => '33% off',
        'booking_text' => 'Skip the line',
        'image_url' => 'https://www.agoda.com/wp-content/uploads/2019/05/Gyeongbokgung-palace-Seoul-Throne-Hall.jpg',
        'is_active' => true
    ],
     [
            'name' => 'N Seoul Tower Entry',
            'destination_id' => $southkorea->id,
            'rating' => 4.5,
            'reviews' => 15000,
            'price' => 15.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://static.wixstatic.com/media/0505b9_f420aceac3b942db958ecf64a43d1762~mv2.jpg/v1/fill/w_922,h_691,al_c,q_85,enc_avif,quality_auto/0505b9_f420aceac3b942db958ecf64a43d1762~mv2.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Bukchon Hanok Village Tour',
                'destination_id' => $southkorea->id,
                'rating' => 4.6,
                'reviews' => 20000,
                'price' => 10.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Book now for today',
                'image_url' => 'https://southkoreahallyu.com/wp-content/uploads/2025/08/bukchon-3.jpg',
                'is_active' => true
    ],
    //Iceland
    [
        'name' => 'Blue Lagoon Entry',
        'destination_id' => $iceland->id,
        'rating' => 4.8,
        'reviews' => 30000,
        'price' => 50.00,
        'original_price' => 70.00,
        'discount_text' => '28% off',
        'booking_text' => 'Book now for today',
        'image_url' => 'https://www.wheretonexttravelblog.com/wp-content/uploads/2017/02/blue-lagoon-to-cieland-entrance-path.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Golden Circle Tour',
            'destination_id' => $iceland->id,
            'rating' => 4.7,
            'reviews' => 25000,
            'price' => 80.00,
            'original_price' => 100.00,
            'discount_text' => '20% off',
            'booking_text' => 'Book now for tomorrow',
            'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/06/71/b1/9b.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Reykjavik City Tour',
                'destination_id' => $iceland->id,
                'rating' => 4.6,
                'reviews' => 20000,
                'price' => 30.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => 'Immediate access',
                'image_url' => 'https://cdn.prod.website-files.com/5d0390443011830c49612c3c/5d931a091ab8d86e4e8f3d2a_Private%20city%20Tour.jpg',
                'is_active' => true
    ],
     [
                'name' => 'Northern Lights Tour',
                'destination_id' => $iceland->id,
                'rating' => 4.9,
                'reviews' => 15000,
                'price' => 100.00,
                'original_price' => 150.00,
                'discount_text' => '33% off',
                'booking_text' => 'Limited availability',
                'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ivdlepfxdwg36ycnuxdd.jpg',
                'is_active' => true
    ],
    //Hokkaido
    [
        'name' => 'Sapporo Snow Festival Tour',
        'destination_id' => $hokkaido->id,
        'rating' => 4.8,
        'reviews' => 20000,
        'price' => 60.00,
        'original_price' => 80.00,
        'discount_text' => '25% off',
        'booking_text' => 'Book now for tomorrow',
        'image_url' => 'https://cdn.gaijinpot.com/app/uploads/sites/6/2018/02/Sapporo-1.jpg',
        'is_active' => true
    ],
     [
            'name' => 'Otaru Canal Cruise',
            'destination_id' => $hokkaido->id,
            'rating' => 4.7,
            'reviews' => 15000,
            'price' => 20.00,
            'original_price' => null,
            'discount_text' => null,
            'booking_text' => 'Immediate access',
            'image_url' => 'https://rimage.gnst.jp/livejapan.com/public/article/detail/a/10/00/a1000323/img/basic/a1000323_main.jpg',
            'is_active' => true
        ],
     [
                'name' => 'Niseko Ski Resort Pass',
                'destination_id' => $hokkaido->id,
                'rating' => 4.9,
                'reviews' => 5000,
                'price' => 100.00,
                'original_price' => 150.00,
                'discount_text' => '33% off',
                'booking_text' => 'Limited availability',
                'image_url' => 'https://rhythmjapan.com/getmedia/f49c20f6-a56d-4e22-8ae0-2f34571d8a6b/smallScenicHighlights23-24_IP-5306.jpg',
                'is_active' => true
    ],
     [
                'name' => "Asahiyama Zoo Entry",
                'destination_id' => $hokkaido->id,
                'rating' => 4.6,
                'reviews' => 20000,
                'price' => 15.00,
                'original_price' => null,
                'discount_text' => null,
                'booking_text' => "Book now for today",
                "image_url" => "https://hokkaido.a4jp.com/wp-content/uploads/2021/08/hokkaido-asahiyama-zoo-ticket-1140x712.jpg",
                'is_active' => true
    ],
     [
                'name' => "Shiretoko National Park Tour",
                'destination_id' => $hokkaido->id,
                'rating' => 4.8,
                'reviews' => 15000,
                'price' => 80.00,
                'original_price' => 100.00,
                'discount_text' => "20% off",
                'booking_text' => "Book now for tomorrow",
                "image_url" => "https://www.wanderingsneakers.com/wp-content/uploads/2018/12/shiretoko13.jpg",
                'is_active' => true
    ],
    // Chiang Mai
        [
            'name' => 'Doi Suthep Temple Tour',
            'destination_id' => $chiangmai->id,
            'rating' => 4.7,
            'reviews' => 25000,
            'price' => 20.00,
            'original_price' => 30.00,
            'discount_text' => '33% off',
            'booking_text' => 'Skip the line',
            'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg',
            'is_active' => true
        ],
        [
                'name' => 'Elephant Sanctuary Visit',
                'destination_id' => $chiangmai->id,
                'rating' => 4.8,
                'reviews' => 15000,
                'price' => 50.00,
                'original_price' => 70.00,
                'discount_text' => '28% off',
                'booking_text' => 'Book now for today',
                'image_url' => 'https://www.elephantnaturepark.org/wp-content/uploads/2025/10/ENP_SkyWalk_Visit_2L.jpg',
                'is_active' => true
            ],
        [
                    'name' => "Chiang Mai Night Bazaar Tour",
                    'destination_id' => $chiangmai->id,
                    'rating' => 4.6,
                    'reviews' => 20000,
                    'price' => 15.00,
                    'original_price' => null,
                    'discount_text' => null,
                    'booking_text' => "Book now for today",
                    "image_url" => "https://www.vivutravel.com/images/des-thailand1/chiang-mai-night-market.jpg",
                    "is_active" => true
        ],
        //Sabah
        [
            'name' => 'Kinabalu Park Tour',
            'destination_id' => $sabah->id,
            'rating' => 4.8,
            'reviews' => 20000,
            'price' => 30.00,
            'original_price' => 50.00,
            'discount_text' => '40% off',
            'booking_text' => 'Book now for tomorrow',
            'image_url' => 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_863/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/iffbqlczmcfmoe96sh2l/KinabaluParkPoringHotSpringTour.jpg',
            'is_active' => true
        ],
        [
                'name' => 'Sipadan Island Diving',
                'destination_id' => $sabah->id,
                'rating' => 4.9,
                'reviews' => 15000,
                'price' => 100.00,
                'original_price' => 150.00,
                'discount_text' => '33% off',
                'booking_text' => 'Limited availability',
                'image_url' => 'https://seaventuresdive.com/wp-content/uploads/2021/11/Bg_faq-1200x799.jpg',
                'is_active' => true
            ],
        [
                    'name' => "Sabah Wildlife Rescue Center",
                    'destination_id' => $sabah->id,
                    'rating' => 4.6,
                    'reviews' => 20000,
                    'price' => 15.00,
                    'original_price' => null,
                    'discount_text' => null,
                    'booking_text' => "Book now for today",
                    "image_url" => "https://mlbq5rotgc8n.i.optimole.com/39b2ZwQ-a_KVV7aw/w:auto/h:auto/q:mauto/f:avif/https://www.stickyricetravel.com/wp-content/uploads/elementor/thumbs/sepilok-1500-1-nupr8yar36oxwovzy1coivaf539cncowklyhn1n1u8.jpg",
                    "is_active" => true
        ],
        [
                    'name' => "Poring Hot Springs Entry",
                    'destination_id' => $sabah->id,
                    'rating' => 4.7,
                    'reviews' => 15000,
                    'price' => 20.00,
                    'original_price' => null,
                    'discount_text' => null,
                    'booking_text' => "Immediate access",
                    "image_url" => "https://travelynnfamily.com/wp-content/uploads/2023/09/Poring-Hot-Springs-3-1024x731.jpg",
                    "is_active" => true
        ],
        //Vietnam
        [
            'name' => 'Halong Bay Cruise',
            'destination_id' => $vietnam->id,
            'rating' => 4.8,
            'reviews' => 20000,
            'price' => 50.00,
            'original_price' => 70.00,
            'discount_text' => '28% off',
            'booking_text' => 'Book now for today',
            'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg',
            'is_active' => true
        ],
            [
                    'name' => 'Hanoi Old Quarter Walking Tour',
                    'destination_id' => $vietnam->id,
                    'rating' => 4.7,
                    'reviews' => 15000,
                    'price' => 20.00,
                    'original_price' => null,
                    'discount_text' => null,
                    'booking_text' => 'Immediate access',
                    'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg',
                    'is_active' => true
                ],
            [
                        'name' => "Ho Chi Minh City Food Tour",
                        'destination_id' => $vietnam->id,
                        'rating' => 4.6,
                        'reviews' => 20000,
                        'price' => 30.00,
                        'original_price' => null,
                        'discount_text' => null,
                        'booking_text' => "Book now for today",
                        "image_url" => "https://www.vivutravel.com/images/des-vietnam1/ho-chi-minh-city-food-tour.jpg",
                        "is_active" => true
            ],

];

        foreach ($attractions as $att) {
            $existing = Attraction::where('name', $att['name'])
                ->where('destination_id', $att['destination_id'])
                ->first();

            if ($existing && !array_key_exists('description', $att)) {
                $att['description'] = $existing->description;
            }

            Attraction::updateOrCreate(
                ['name' => $att['name'], 'destination_id' => $att['destination_id']],
                $att
            );
        }
    }
}