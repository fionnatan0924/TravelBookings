<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotels = [
            // Kuala Lumpur
            [
                'name' => 'Grand Plaza KLCC',
                'city' => 'Kuala Lumpur',
                'address' => '123 Jalan Ampang, KLCC, Kuala Lumpur',
                'price_per_night' => 250,
                'stars' => 5,
                'image' => 'https://pix10.agoda.net/hotelImages/69231/1140243671/816f602882a3d6545f715d97bdc396b2.jpg?ce=2&s=414x232',
                'description' => 'Luxury hotel right next to the Petronas Twin Towers with stunning city views, an infinity pool, and fine dining.',
                'gallery' => json_encode([
                    'https://pix10.agoda.net/hotelImages/69231/1140243671/816f602882a3d6545f715d97bdc396b2.jpg?ce=2&s=414x232',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuosM2XYfzrp5hgkDziD-Ev9z-BIv5OuEecQ&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAH1nZZ0p87VSCh1diDzB1cxldLe0B9j75Zw&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4oeYrsLpAgZJiRI8ZQAZQW6glCch7VErg6g&s',
                ]),
                'amenities' => 'Infinity Pool, Spa, Fitness Centre, Restaurant, Free Wi-Fi, Airport Shuttle',
                'check_in_time' => '15:00',
                'check_out_time' => '12:00',
            ],
            [
                'name' => 'Bukit Bintang Hotel',
                'city' => 'Kuala Lumpur',
                'address' => '45 Jalan Bukit Bintang, Kuala Lumpur',
                'price_per_night' => 120,
                'stars' => 4,
                'image' => 'https://images.trvl-media.com/lodging/10000000/9430000/9422900/9422821/425af00d.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                'description' => 'Modern hotel in the heart of Kuala Lumpur’s entertainment district, close to shopping malls and nightlife.',
                'gallery' => json_encode([
                    'https://images.trvl-media.com/lodging/10000000/9430000/9422900/9422821/425af00d.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://images.trvl-media.com/lodging/90000000/89690000/89681200/89681136/fc87a707.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://images.luxuryescapes.com/fl_progressive,q_auto:best,dpr_2.0/q9onughnx5ydw6smauee',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-30OSLqR3KcpZBmB4qhyUCjhbQN0Ku9kSVg&s',
                ]),
                'amenities' => 'Rooftop Bar, Outdoor Pool, Free Wi-Fi, 24-hour Front Desk, Concierge',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Penang
            [
                'name' => 'Seaside Resort Batu Ferringhi',
                'city' => 'Penang',
                'address' => '1 Batu Ferringhi Beach Road, Penang',
                'price_per_night' => 180,
                'stars' => 4,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTti4_c5CiIHGtAN4VHt255Zs_bq9OJAuAsOg&s',
                'description' => 'Beachfront resort with water sports, sunset views, and authentic local cuisine.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTti4_c5CiIHGtAN4VHt255Zs_bq9OJAuAsOg&s',
                    'https://www.awaygowe.com/wp-content/uploads/2022/02/batu-ferringhi-reasons-02-hard-rock.jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyWTU61iQ88wy5SzAXqbPOHsqTmmbkEI1Ptg&s',
                ]),
                'amenities' => 'Private Beach, Outdoor Pool, Restaurant, Water Sports, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '12:00',
            ],
            [
                'name' => 'George Town Heritage Hotel',
                'city' => 'Penang',
                'address' => '22 Lebuh Armenian, Penang',
                'price_per_night' => 120,
                'stars' => 3,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnsH1Kq3fOPGPDMKg-OE6vnGImznOOeOpEMA&s',
                'description' => 'Charming hotel in the UNESCO World Heritage area, surrounded by street art and historic buildings.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnsH1Kq3fOPGPDMKg-OE6vnGImznOOeOpEMA&s',
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/79617971.jpg?k=47a8e43039cb3a80cb4a3602e394a4b14bc30367da05f325f3a9dd723acb1d4a&o=',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTl4XUNse4NgSM3BG_hH5Yh9F5BtXCUWbbirA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9H_FYXR0i6yikQBiNetd3g1BCaf0pgOA63g&s',
                ]),
                'amenities' => 'Heritage Building, Cafe, Free Wi-Fi, Air Conditioning',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Langkawi
            [
                'name' => 'Langkawi Lagoon Resort',
                'city' => 'Langkawi',
                'address' => 'Pantai Cenang, Langkawi',
                'price_per_night' => 200,
                'stars' => 4,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWGofAsYEBF5fNSI2ZiYxunAy2JB3z-XX0jA&s',
                'description' => 'Spacious resort with overwater chalets and direct access to the lagoon.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWGofAsYEBF5fNSI2ZiYxunAy2JB3z-XX0jA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-QYv5fpducHKc8PP2NjrO4-oFtHo4h7bJVg&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToKrrkxdWLyfTMk7OgQeZrSpbPDeMp2D143A&s',
                    'https://www.langkawilagoon-resort.com/wp-content/uploads/2013/05/langkawi-lagoon-resort-about-hotel.jpg',
                ]),
                'amenities' => 'Lagoon Pool, Water Sports, Spa, Restaurant, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '12:00',
            ],

            // Johor Bahru
            [
                'name' => 'JB City Square Hotel',
                'city' => 'Johor Bahru',
                'address' => '88 Jalan Wong Ah Fook, Johor Bahru',
                'price_per_night' => 90,
                'stars' => 3,
                'image' => 'https://images.trvl-media.com/lodging/49000000/48680000/48677800/48677759/64158dfd.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                'description' => 'Convenient hotel connected to City Square Mall, near Singapore border.',
                'gallery' => json_encode([
                    'https://images.trvl-media.com/lodging/49000000/48680000/48677800/48677759/64158dfd.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKlOC6z6cbeOItOuvSP2bWyufnuWB8TFflFA&s',
                    'https://images.trvl-media.com/lodging/114000000/113320000/113314700/113314662/3d995094_y.jpg',
                ]),
                'amenities' => 'Free Wi-Fi, 24-hour Front Desk, Air Conditioning',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Sabah (Kota Kinabalu)
            [
                'name' => 'Kinabalu Mountain View Resort',
                'city' => 'Sabah',
                'address' => 'Jalan Tun Fuad Stephens, Kota Kinabalu, Sabah',
                'price_per_night' => 120,
                'stars' => 3,
                'image' => 'https://mountainvalley.com.my/images/room/room5.jpg',
                'description' => 'Resort with stunning views of Mount Kinabalu, ideal for nature lovers.',
                'gallery' => json_encode([
                    'https://mountainvalley.com.my/images/room/room5.jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRyTRWKzSVWIbtht1VbyG8q-owi96DUHueNg&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHduzsF7l10diQBlTQEEwZOho0hQGqcB_i4w&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTszaNwSa41DA2ABbI2iIfNlEuWIIZYuuxCEw&s',
                ]),
                'amenities' => 'Mountain Views, Hiking Trails, Restaurant, Free Wi-Fi',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Singapore
            [
                'name' => 'Marina Bay Sands View Hotel',
                'city' => 'Singapore',
                'address' => '10 Bayfront Avenue, Singapore',
                'price_per_night' => 350,
                'stars' => 5,
                'image' => 'https://pix10.agoda.net/hotelImages/185945/1182653655/c14d4001f928c5dc12254cc841d30888.jpg?ce=2&s=414x232',
                'description' => 'Iconic hotel with stunning skyline views and rooftop infinity pool.',
                'gallery' => json_encode([
                    'https://pix10.agoda.net/hotelImages/185945/1182653655/c14d4001f928c5dc12254cc841d30888.jpg?ce=2&s=414x232',
                    'https://www.marinabaysands.com/content/dam/marinabaysands/hotel/the-sands-collection-landing-page/room-listing/sands-premier-studio-1.jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQncEp4LSb0wzV87rlzCm-RXDuQxG66-rwGw&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR80uPlmANYdelc1jtxBIl56w16z2xvrzJifA&s',
                ]),
                'amenities' => 'Infinity Pool, Casino, Restaurants, Spa, Gym',
                'check_in_time' => '15:00',
                'check_out_time' => '11:00',
            ],
            [
                'name' => 'Chinatown Boutique Inn',
                'city' => 'Singapore',
                'address' => '22 Temple Street, Singapore',
                'price_per_night' => 110,
                'stars' => 3,
                'image' => 'https://www.myboutiquehotel.com/photos/110247/duxton-reserve-singapore-autograph-collection-singapore-121-02758-728x400.jpg',
                'description' => 'Chic boutique hotel in the heart of Chinatown, close to Maxwell Food Centre.',
                'gallery' => json_encode([
                    'https://www.myboutiquehotel.com/photos/110247/duxton-reserve-singapore-autograph-collection-singapore-121-02758-728x400.jpg',
                    'https://cf.bstatic.com/xdata/images/hotel/270x200/651416295.webp?k=540273512f20cfd77cb18660a081d40927df6f853658b35ef9dafc1df2dd1690&o=',
                    'https://placesofjuma.com/wp-content/uploads/2022/10/buddha-bar-hotel-4.jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzT-l-DFMTRVF_w_ZYJVLqDKMZc5Xvmo4TTg&s',
                ]),
                'amenities' => 'Free Wi-Fi, Rooftop Terrace, Air Conditioning, Concierge',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Bangkok
            [
                'name' => 'Bangkok Riverside Hotel',
                'city' => 'Bangkok',
                'address' => '123 Chao Phraya Road, Bangkok',
                'price_per_night' => 220,
                'stars' => 5,
                'image' => 'https://images.trvl-media.com/lodging/3000000/2560000/2559000/2558980/c40c114b.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                'description' => 'Luxury hotel along the Chao Phraya River with rooftop bar and infinity pool.',
                'gallery' => json_encode([
                    'https://images.trvl-media.com/lodging/3000000/2560000/2559000/2558980/c40c114b.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPnYtYTyFusGOGhiVHjTHl3wNnrVvVKfbecA&s',
                    'https://images.trvl-media.com/lodging/14000000/13180000/13172100/13172072/8a35e1d7.jpg?impolicy=fcrop&w=357&h=201&p=1&q=medium',
                    'https://images.squarespace-cdn.com/content/v1/570841f52fe13162046773b8/1482642006552-MC97N53XVOVE9BMV4NT3/image-asset.jpeg',
                ]),
                'amenities' => 'Rooftop Pool, River View, Spa, Fine Dining, Free Wi-Fi',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],
            [
                'name' => 'Sukhumvit Budget Stay',
                'city' => 'Bangkok',
                'address' => '45 Sukhumvit Soi 11, Bangkok',
                'price_per_night' => 60,
                'stars' => 2,
                'image' => 'https://images.trvl-media.com/lodging/1000000/530000/521000/520975/cd2ce8dd.jpg?impolicy=fcrop&w=357&h=201&p=1&q=medium',
                'description' => 'Affordable rooms in the vibrant Sukhumvit area, close to BTS Skytrain.',
                'gallery' => json_encode([
                    'https://images.trvl-media.com/lodging/1000000/530000/521000/520975/cd2ce8dd.jpg?impolicy=fcrop&w=357&h=201&p=1&q=medium',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS052erWg0AGXQyHXEBWfeGk1D1mkDNxOAPLg&s',
                    'https://pix10.agoda.net/hotelImages/10690/-1/3e1fc1c303e70b1607681fb273e73d06.jpg?ce=0&s=702x392',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1c5DJliQPvbJT6ZuWBKc5_vbpmHYlHjjHiQ&s',
                ]),
                'amenities' => '24-hour Front Desk, Free Wi-Fi, Air Conditioning, Shared Lounge',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Chiang Mai
            [
                'name' => 'Old City Boutique Hotel',
                'city' => 'Chiang Mai',
                'address' => '24 Ratchadamnoen Road, Chiang Mai',
                'price_per_night' => 85,
                'stars' => 3,
                'image' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/410986144.jpg?k=be1af3f4b329e8b6784cb0ca578d76b479e405f50b4b422f36807967d15df5fe&o=',
                'description' => 'Charming boutique hotel inside the old city walls, near temples.',
                'gallery' => json_encode([
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/410986144.jpg?k=be1af3f4b329e8b6784cb0ca578d76b479e405f50b4b422f36807967d15df5fe&o=',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5nimnBm33t8j4z-bDYUuCe7AWvUNAtfL7Ig&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSin8mezACJnxSHypZ7M0MEWhCEAtR18N2tGA&s',
                    'https://q-xx.bstatic.com/xdata/images/hotel/max500/331734994.jpg?k=09603c729b54f75425f55dafd4b87537b9283c7272fa31a16a43ed0e1813b3b1&o=',
                ]),
                'amenities' => 'Free Breakfast, Bicycle Rental, Tour Desk, Free Wi-Fi',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Bali
            [
                'name' => 'Bali Dream Resort',
                'city' => 'Bali',
                'address' => 'Jl. Pantai Kuta, Bali',
                'price_per_night' => 150,
                'stars' => 4,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDId6ZETod-Z9ulQ_4PJQA3WLigBOxJFZNzg&s',
                'description' => 'Tropical paradise with lush gardens and traditional Balinese spa.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDId6ZETod-Z9ulQ_4PJQA3WLigBOxJFZNzg&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAP-ivnN9fB92co3Nqvv89mcU-C-VBsL-4LQ&s',
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/756946665.jpg?k=f6b85de7f06162e7cee9c454f8487df26aa5c256df32df300bcd01e249fa4d73&o=',
                    'https://my-dream-resort-spa-ungasan.all-balihotels.net/data/Photos/OriginalPhoto/17197/1719714/1719714806.JPEG',
                ]),
                'amenities' => 'Private Pool, Spa, Restaurant, Yoga Classes, Free Wi-Fi',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Tokyo
            [
                'name' => 'Shinjuku Central Hotel',
                'city' => 'Tokyo',
                'address' => '3-5-7 Shinjuku, Tokyo',
                'price_per_night' => 280,
                'stars' => 4,
                'image' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/65536176.jpg?k=f4c55596c54df2fe63b04ad2838ccb54ca19b37c0ef1fd553368d811bcc0f489&o=',
                'description' => 'Modern hotel in the heart of Shinjuku, close to nightlife and transport.',
                'gallery' => json_encode([
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/65536176.jpg?k=f4c55596c54df2fe63b04ad2838ccb54ca19b37c0ef1fd553368d811bcc0f489&o=',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD9FEkb6vyQB8yJFPtDLOhGDyP4ePcrv5uiQ&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtu_q65WhyxO1uqcPjt1AVTX5oKPyYlPTOyw&s',
                    'https://images.trvl-media.com/lodging/3000000/2010000/2009700/2009694/df1ccf90.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                ]),
                'amenities' => '24h Front Desk, Restaurant, Laundry, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '10:00',
            ],

            // Hokkaido
            [
                'name' => 'Sapporo Snow Lodge',
                'city' => 'Hokkaido',
                'address' => '10 Kita-jo, Sapporo, Hokkaido',
                'price_per_night' => 160,
                'stars' => 3,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJsYs00pWvAxQelgleuJeMGMjF_tkepQGHBg&s',
                'description' => 'Cozy lodge near ski slopes, perfect for winter sports enthusiasts.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJsYs00pWvAxQelgleuJeMGMjF_tkepQGHBg&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjR5rJiRdRpxmGGLqacMPW6mVNMh7QxWgBZw&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNPA4tXdD0flBoa40JD23wihfH1YMBO4qbTA&s',
                    'https://www.japan-experience.com/sites/default/files/styles/scale_crop_480x250/public/legacy/japan_experience/1541999219817.png.webp?h=ed67e9d6&itok=Hn_mQ_el',
                ]),
                'amenities' => 'Ski Storage, Hot Springs, Restaurant, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '10:00',
            ],

            // Paris
            [
                'name' => 'Eiffel Tower View Hotel',
                'city' => 'Paris',
                'address' => '15 Rue de la Paix, Paris',
                'price_per_night' => 350,
                'stars' => 5,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBpptVdaAU43VnWpjEp0ip4kZnf7WSnQDoLA&s',
                'description' => 'Elegant hotel with direct views of the Eiffel Tower and fine dining.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBpptVdaAU43VnWpjEp0ip4kZnf7WSnQDoLA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzdufPDgoz_UznPcnB6eNzWXQQRGyrhyLj3w&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG_1_tVnVQ5Ojpx7qOGGK9_T7MdUGGDJ5KLA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-esPqaiVo1xQgbzQnAwGjAaT7kPJt9V7rvA&s',
                ]),
                'amenities' => 'Eiffel View, Michelin Restaurant, Concierge, Spa',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Hong Kong
            [
                'name' => 'Victoria Harbour Hotel',
                'city' => 'Hong Kong',
                'address' => '1 Harbour Road, Wan Chai',
                'price_per_night' => 270,
                'stars' => 4,
                'image' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/13/0b/8d/0b/hotel-vic-on-the-harbour.jpg?w=900&h=500&s=1',
                'description' => 'Harbourfront hotel with panoramic views and rooftop pool.',
                'gallery' => json_encode([
                    'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/13/0b/8d/0b/hotel-vic-on-the-harbour.jpg?w=900&h=500&s=1',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPunSj5tPyaoNd_pkh9eBV2FeawjqpgCk4KA&s',
                    'https://images.trvl-media.com/lodging/22000000/21320000/21318800/21318769/1dc5ac69.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBtCgvYLkyBTMTfZ_4H8W1HtByehP_y_F3-A&s',
                ]),
                'amenities' => 'Rooftop Pool, Gym, Business Centre, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '12:00',
            ],

            // Maldives
            [
                'name' => 'Overwater Bungalow Resort',
                'city' => 'Maldives',
                'address' => 'North Male Atoll',
                'price_per_night' => 550,
                'stars' => 5,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBGGDDFrd7cimAjsB0hebqR_tZNpm67foqgA&s',
                'description' => 'Ultra‑luxury overwater villas with direct lagoon access and personal butlers.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBGGDDFrd7cimAjsB0hebqR_tZNpm67foqgA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLUNRu3bDFq_Vd1KHgyRMFqiT_KR0GS_iXTA&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROmLKGtHn39PuM_5M4bfnKyAVE8Y6bIDzB2g&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQovrq7XczHR1dYcX2DHfnhCYwgu6CLj-YPGg&s',
                ]),
                'amenities' => 'Overwater Villas, Private Pool, Spa, Fine Dining, Water Sports',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Guangzhou
            [
                'name' => 'Canton Tower Hotel',
                'city' => 'Guangzhou',
                'address' => '123 Yuexiu District, Guangzhou',
                'price_per_night' => 130,
                'stars' => 4,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPadd6-YH607JhYKrtPoS9NxXbTqGgaJYl0g&s',
                'description' => 'Modern hotel with views of the iconic Canton Tower.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPadd6-YH607JhYKrtPoS9NxXbTqGgaJYl0g&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfnRbeAIhAcfCZssIpikvyN0ngPl8u2Okmcw&s',
                    'https://www.fourseasons.com/alt/img-opt/~70.1530.0,0000-208,8816-3000,0000-1687,5000/publish/content/dam/fourseasons/images/web/GUA/GUA_1793_original.jpg',
                    'https://i0.wp.com/coremagazines.com/wp-content/uploads/2017/03/Guangzhou-bathtub-photo-Romeo-Crow.jpg?resize=474%2C474&ssl=1',
                ]),
                'amenities' => 'Fitness Centre, Restaurant, Free Wi-Fi, Business Centre',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Shanghai
            [
                'name' => 'The Bund Riverside Hotel',
                'city' => 'Shanghai',
                'address' => '20 Zhongshan East Road, Shanghai',
                'price_per_night' => 210,
                'stars' => 5,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIAY90rqDYGZIxA0v_IWbdEhKxPNWdD1fjmQ&s',
                'description' => 'Luxury hotel on The Bund with breathtaking Huangpu River views.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIAY90rqDYGZIxA0v_IWbdEhKxPNWdD1fjmQ&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLJghSgnDDN9YFISVJQEpfYse5RdlKia4j0Q&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPuLiMa3ZKJyqMaxL0ZKEQ_I3Wx9V2obF1hQ&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS28h760fDIRKQ4rxS2V6cSr71cAeUr_J1kfQ&s',
                ]),
                'amenities' => 'River View, Rooftop Bar, Spa, Fine Dining',
                'check_in_time' => '15:00',
                'check_out_time' => '12:00',
            ],

            // Chongqing
            [
                'name' => 'Mountain View Hotel',
                'city' => 'Chongqing',
                'address' => '45 Jiefangbei Central, Chongqing',
                'price_per_night' => 100,
                'stars' => 3,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnZsyX1cZuItB01rbrwhDl3gc2Ji-b8-QIgQ&s',
                'description' => 'Comfortable hotel overlooking the city’s mountainous skyline.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnZsyX1cZuItB01rbrwhDl3gc2Ji-b8-QIgQ&s',
                    'https://images.trvl-media.com/lodging/25000000/24330000/24326800/24326772/87d70ed6.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill',
                    'https://www.onsenmoncham.com/wp-content/uploads/2020/12/Grand-Mountain-View-01.jpg',
                    'https://www.onsenmoncham.com/wp-content/uploads/2021/08/Grand-Terrace-Suite-with-Outdoor-Onsen1-640x360.jpg',
                ]),
                'amenities' => 'Free Wi-Fi, Restaurant, 24-hour Front Desk',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Hanoi
            [
                'name' => 'Old Quarter Inn',
                'city' => 'Hanoi',
                'address' => '12 Hang Bac Street, Hanoi',
                'price_per_night' => 70,
                'stars' => 3,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9q_YUz-U1Z-0R-OP-YCIq77r2RZh7HFRS5Q&s',
                'description' => 'Cozy hotel in the heart of Hanoi’s historic Old Quarter.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9q_YUz-U1Z-0R-OP-YCIq77r2RZh7HFRS5Q&s',
                    'https://www.ca.kayak.com/rimg/himg/6e/d2/70/expediav2-171135-2dc549-812756.jpg?width=836&height=607&crop=true',
                    'https://media-cdn.tripadvisor.com/media/photo-s/1c/37/41/9c/double-canal-view-room.jpg',
                    'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/34/6e/1a/twin-canal-room.jpg?w=700&h=-1&s=1',
                ]),
                'amenities' => 'Free Breakfast, Tour Desk, Free Wi-Fi',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
            ],

            // Seoul
            [
                'name' => 'Myeongdong Central Hotel',
                'city' => 'Seoul',
                'address' => '55 Myeongdong-gil, Seoul',
                'price_per_night' => 180,
                'stars' => 4,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcdFMKHgfrmaWI2f-IZ6Ebs-y7y1ldu00d4w&s',
                'description' => 'Prime location in Myeongdong shopping district, modern rooms.',
                'gallery' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcdFMKHgfrmaWI2f-IZ6Ebs-y7y1ldu00d4w&s',
                    'https://cf.bstatic.com/xdata/images/hotel/max1024x768/658181166.jpg?k=b3c6502fdac7bce7df358a8304820bac95e5711743cd98393eee31366cae3221&o=',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHQD-58OglQS8PzeZ6PkFo_lP8VyxP4v9m3w&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWtP84wSQutKBsWK6myQZSZ-me99GGX52wgA&s',
                ]),
                'amenities' => 'Rooftop Terrace, Fitness Centre, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '11:00',
            ],

            // Reykjavik (Iceland)
            [
                'name' => 'Northern Lights Hotel',
                'city' => 'Iceland',
                'address' => 'Reykjavik City Center',
                'price_per_night' => 220,
                'stars' => 4,
                'image' => 'https://images.unsplash.com/photo-1556013986-4d5c8e2f0c6b?w=400',
                'description' => 'Cozy hotel with views of the Northern Lights and easy access to geothermal springs.',
                'gallery' => json_encode([
                    'https://images.unsplash.com/photo-1556013986-4d5c8e2f0c6b?w=400',
                    'https://images.unsplash.com/photo-1506966957602-8e9f3f0a4f4e?w=400',
                    'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=400',
                ]),
                'amenities' => 'Geothermal Pool, Northern Lights Viewing, Restaurant, Free Wi-Fi',
                'check_in_time' => '15:00',
                'check_out_time' => '11:00',
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}