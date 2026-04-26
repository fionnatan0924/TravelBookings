<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Attraction;

class DestinationsAndAttractionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ------------------------------------------------------------
        // 1. DESTINATIONS 
        // ------------------------------------------------------------
        $destinations = [
            ['name' => 'Kuala Lumpur', 'starting_price' => 150, 'color' => '#FF6B6B', 'image_url' => 'https://www.hostelworld.com/blog/wp-content/uploads/dreamstimesmall_322299871.jpg'],
            ['name' => 'Penang', 'starting_price' => 120, 'color' => '#4ECDC4', 'image_url' => 'https://ik.imagekit.io/tvlk/blog/2023/05/penang_temple-4580960-Copy.jpg'],
            ['name' => 'Langkawi', 'starting_price' => 180, 'color' => '#45B7D1', 'image_url' => 'https://panoramalangkawi.com/wp-content/uploads/2020/06/hnI9yf1.jpg'],
            ['name' => 'Bangkok', 'starting_price' => 200, 'color' => '#96CEB4', 'image_url' => 'https://samaaratravel.com/assets/img/tour/thailand/thailand19.jpg'],
            ['name' => 'Singapore', 'starting_price' => 250, 'color' => '#FFD93D', 'image_url' => 'https://geographical.co.uk/wp-content/uploads/singapore-1.jpg'],
            ['name' => 'Bali', 'starting_price' => 899, 'color' => '#E6A57E', 'image_url' => 'https://www.hostelworld.com/blog/wp-content/uploads/dreamstimesmall_322299871.jpg'],
            ['name' => 'Tokyo', 'starting_price' => 1999, 'color' => '#7AA6C2', 'image_url' => 'https://www.advantour.com/img/japan/images/tokyo.jpg'],
            ['name' => 'Paris', 'starting_price' => 2599, 'color' => '#BFA5D6', 'image_url' => 'https://media-cdn.tripadvisor.com/media/photo-c/1280x250/17/15/6d/d6/paris.jpg'],
            ['name' => 'Hong Kong', 'starting_price' => 1200, 'color' => '#FF9F1C', 'image_url' => 'https://cdn.britannica.com/34/123334-050-7B38F2E0/Shopping-district-Kowloon-Hong-Kong.jpg'],
            ['name' => 'Maldives', 'starting_price' => 3299, 'color' => '#80C9C3', 'image_url' => 'https://www.lilybeachmaldives.com/wp-content/uploads/2017/09/aerial-2.jpg'],
            ['name' => 'Johor Bahru', 'starting_price' => 100, 'color' => '#A8E6CF', 'image_url' => 'https://cdn.i-scmp.com/sites/default/files/d8/images/methode/2020/04/10/56349a2c-7a3e-11ea-9b24-e7152d1bf921_image_hires_052345.JPG'],
            ['name' => 'Guangzhou', 'starting_price' => 800, 'color' => '#FFB347', 'image_url' => 'https://res.klook.com/image/upload/fl_lossy.progressive,q_60/Mobile/City/kzoqsln765itrqe6j4eb.jpg'],
            ['name' => 'Shanghai', 'starting_price' => 1100, 'color' => '#5D9B9B', 'image_url' => 'https://cdn.britannica.com/08/187508-050-D6FB5173/Shanghai-Tower-Gensler-San-Francisco-world-Oriental-2015.jpg'],
            ['name' => 'Chongqing', 'starting_price' => 600, 'color' => '#D4A5A5', 'image_url' => 'https://images.travelandleisureasia.com/wp-content/uploads/sites/5/2024/12/04163323/Chongqing-1-1600x900.jpg'],
            ['name' => 'Vietnam', 'starting_price' => 350, 'color' => '#9B5DE5', 'image_url' => 'https://static.independent.co.uk/2025/08/04/14/15/iStock-2165819723.jpg'],
            ['name' => 'South Korea', 'starting_price' => 1400, 'color' => '#F15BB5', 'image_url' => 'https://www.celebritycruises.com/blog/content/uploads/2025/03/what-is-south-korea-famous-for-busan-haedong-yonggungsa-temple-hero-1920x890-1742156883.jpg'],
            ['name' => 'Hokkaido', 'starting_price' => 1600, 'color' => '#00BBF9', 'image_url' => 'https://tampamagazines.com/wp-content/uploads/2025/03/Skiing-in-Hokkaido-scaled.jpg'],
            ['name' => 'Chiang Mai', 'starting_price' => 280, 'color' => '#FEE440', 'image_url' => 'https://live.staticflickr.com/65535/49135949801_1981a4d55e_z.jpg'],
            ['name' => 'Sabah', 'starting_price' => 380, 'color' => '#9C89B8', 'image_url' => 'https://sabahtourism.com/assets/uploads/iStock-460674101-1024x683.jpg'],
            ['name' => 'Iceland', 'starting_price' => 2800, 'color' => '#6B8E9B', 'image_url' => 'https://res.cloudinary.com/icelandtours/image/upload/v1670580099/flatey_island_summer_e2506cca1c.jpg'],
        ];

        foreach ($destinations as $destData) {
            Destination::updateOrCreate(
                ['name' => $destData['name']], // unique key
                [
                    'starting_price' => $destData['starting_price'],
                    'color'          => $destData['color'],
                    'image_url'      => $destData['image_url'],
                ]
            );
        }

        // ------------------------------------------------------------
        // 2. ATTRACTIONS 
        // ------------------------------------------------------------
        $attractions = [
            // Bali
            ['name' => 'Waterbom Bali', 'destination' => 'Bali', 'rating' => 4.7, 'reviews' => 17828, 'price' => 71.00, 'original_price' => 79.00, 'discount_text' => '10% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.bushwalkingblog.com.au/wp-content/uploads/2019/09/waterbom-bali.jpg', 'is_active' => true],
            ['name' => 'Penida Island', 'destination' => 'Bali', 'rating' => 4.4, 'reviews' => 1199, 'price' => 18.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://cdn.sanity.io/images/nxpteyfv/goguides/d3e2eaa78fd09fb627fc73a574aab803cc203296-1600x1066.jpg', 'is_active' => true],
            ['name' => 'Ubud Palace', 'destination' => 'Bali', 'rating' => 4.4, 'reviews' => 1085, 'price' => 0.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Free entry', 'image_url' => 'https://www.bondingexplorers.com/wp-content/uploads/2025/07/mina-main.jpg', 'is_active' => true],
            ['name' => 'Ayung River Rafting', 'destination' => 'Bali', 'rating' => 4.6, 'reviews' => 650, 'price' => 35.00, 'original_price' => 45.00, 'discount_text' => '22% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://asiantrails.b-cdn.net/wp-content/uploads/2021/03/rafting-1600x900-1.jpg', 'is_active' => true],
            
            // Tokyo
            ['name' => 'Tokyo Disneyland', 'destination' => 'Tokyo', 'rating' => 9.4, 'reviews' => 78200, 'price' => 85.00, 'original_price' => 110.00, 'discount_text' => '23% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://cdn.cheapoguides.com/wp-content/uploads/sites/2/2022/10/tokyo-disneyland-castle_klook-1024x600.jpg', 'is_active' => true],
            ['name' => 'Shibuya Sky Observation', 'destination' => 'Tokyo', 'rating' => 9.1, 'reviews' => 45200, 'price' => 22.00, 'original_price' => 28.00, 'discount_text' => '21% off', 'booking_text' => 'Mobile ticket', 'image_url' => 'https://nightscape.tokyo/en/wp-content/uploads/2023/01/shibuya-sky-1.jpg', 'is_active' => true],
            ['name' => 'Senso-ji Temple Tour', 'destination' => 'Tokyo', 'rating' => 8.8, 'reviews' => 51508, 'price' => 18.00, 'original_price' => 25.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.japan-guide.com/g18/3001_01.jpg', 'is_active' => true],
            ['name' => 'Tokyo Tower Entry', 'destination' => 'Tokyo', 'rating' => 8.5, 'reviews' => 32000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://www.pelago.com/img/products/JP-Japan/tokyo-tower-observatory-entry-tickets/0405-0238_tokyo-tower-observatory-entry-tickets-japan-pelago0-xlarge.jpg', 'is_active' => true],
            
            // Paris
            ['name' => 'Eiffel Tower Summit Access', 'destination' => 'Paris', 'rating' => 9.2, 'reviews' => 120000, 'price' => 30.00, 'original_price' => 45.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/12/41/5c/8d.jpg', 'is_active' => true],
            ['name' => 'Louvre Museum Fast Track', 'destination' => 'Paris', 'rating' => 9.0, 'reviews' => 85000, 'price' => 25.00, 'original_price' => 35.00, 'discount_text' => '29% off', 'booking_text' => 'Mobile ticket', 'image_url' => 'https://assets.travelloapp.com/uploads/deal/e7a29abe7cbda9452528c3fe6323770692c01ac71d4420266218601eb5c744a0.jpg', 'is_active' => true],
            
            // Maldives
            ['name' => 'Maldives Snorkeling Adventure', 'destination' => 'Maldives', 'rating' => 9.5, 'reviews' => 5000, 'price' => 50.00, 'original_price' => 70.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://dth.travel/wp-content/uploads/2023/10/Happy-family-girl-in-snorkeling-mask-dive-underwater-with-tropical-fishes-in-coral-reef-sea-pool.-Travel-lifestyle-water-sport-outdoor-adventure_shutterstock_648353362-scaled.jpg', 'is_active' => true],
            ['name' => 'Maldives Sunset Cruise', 'destination' => 'Maldives', 'rating' => 9.3, 'reviews' => 3000, 'price' => 40.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://www.lilybeachmaldives.com/wp-content/uploads/2018/08/dolphin-sunset-cruise.jpg', 'is_active' => true],
            
            // Penang
            ['name' => 'George Town Street Art Tour', 'destination' => 'Penang', 'rating' => 4.6, 'reviews' => 5421, 'price' => 25.00, 'original_price' => 30.00, 'discount_text' => '17% off', 'booking_text' => 'Book today', 'image_url' => 'https://www.toptravelsights.com/wp-content/uploads/2020/05/Penang-Street-Art-6.jpg', 'is_active' => true],
            ['name' => 'Penang Hill Funicular', 'destination' => 'Penang', 'rating' => 4.5, 'reviews' => 3200, 'price' => 10.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://res.klook.com/images/w_1200,h_630,c_fill,q_65/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ifgx0tnarl0ybpnltcxb/PenangHillFunicularRailwayTicket(ForNon-MalaysianOnly)-KlookUnitedStates.jpg', 'is_active' => true],
            ['name' => 'Penang Botanic Gardens', 'destination' => 'Penang', 'rating' => 4.4, 'reviews' => 2100, 'price' => 5.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Free entry', 'image_url' => 'https://cdn.forevervacation.com/uploads/attraction/penang-botanic-gardens-4928.jpg', 'is_active' => true],
            ['name' => 'Penang Street Food Tour', 'destination' => 'Penang', 'rating' => 4.7, 'reviews' => 4500, 'price' => 30.00, 'original_price' => 40.00, 'discount_text' => '25% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.pelago.com/img/products/MY-Malaysia/penang-street-food-in-georgetown-and-history-walking-audio-tour/8dabaace-a0f6-46b6-912e-768bca9c3c08_penang-street-food-in-georgetown-and-history-walking-audio-tour-xlarge.jpg', 'is_active' => true],
            
            // Langkawi
            ['name' => 'Langkawi Sky Bridge', 'destination' => 'Langkawi', 'rating' => 4.8, 'reviews' => 15000, 'price' => 15.00, 'original_price' => 20.00, 'discount_text' => '25% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/12/6e/cf/28.jpg', 'is_active' => true],
            ['name' => 'Island Hopping Tour', 'destination' => 'Langkawi', 'rating' => 4.6, 'reviews' => 6543, 'price' => 60.00, 'original_price' => 75.00, 'discount_text' => '20% off', 'booking_text' => 'Limited availability', 'image_url' => 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_720/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/oeip0notjbakgq9khtcu/LangkawiIslandHoppingSharedSpeedboatTour.jpg', 'is_active' => true],
            
            // Bangkok
            ['name' => 'Grand Palace Tour', 'destination' => 'Bangkok', 'rating' => 4.8, 'reviews' => 20000, 'price' => 80.00, 'original_price' => 95.00, 'discount_text' => '17% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit800600gsm/eventThirdParty/2022/05/05/9c07d176-6a89-436b-898a-c64590a49c2f-1651714938547-74b8b6a4166c761426c84dfd69e1751a.jpg', 'is_active' => true],
            ['name' => 'River Cruise Dinner', 'destination' => 'Bangkok', 'rating' => 4.9, 'reviews' => 5000, 'price' => 40.00, 'original_price' => 50.00, 'discount_text' => '20% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/07/70/4a/ad.jpg', 'is_active' => true],
            
            // Singapore
            ['name' => 'Gardens by the Bay', 'destination' => 'Singapore', 'rating' => 4.7, 'reviews' => 25000, 'price' => 20.00, 'original_price' => 28.00, 'discount_text' => '29% off', 'booking_text' => 'Mobile ticket', 'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/0d/Marina_Bay_Sands_from_Gardens_By_The_Bay.jpg', 'is_active' => true],
            ['name' => 'Universal Studios Singapore', 'destination' => 'Singapore', 'rating' => 9.1, 'reviews' => 18000, 'price' => 280.00, 'original_price' => 320.00, 'discount_text' => '12% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://d2mgzmtdeipcjp.cloudfront.net/files/magazine/2025/02/02/17384898052455.jpg', 'is_active' => true],
            ['name' => 'Singapore Flyer', 'destination' => 'Singapore', 'rating' => 4.5, 'reviews' => 15000, 'price' => 30.00, 'original_price' => 40.00, 'discount_text' => '25% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://www.pelago.com/img/collections/singapore-flyer/0712-0705_singapore-flyer.jpg', 'is_active' => true],
            
            // Hong Kong
            ['name' => 'Victoria Peak Tram', 'destination' => 'Hong Kong', 'rating' => 4.6, 'reviews' => 22000, 'price' => 10.00, 'original_price' => 15.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ifm3ngwvqoxifp49etyf.jpg', 'is_active' => true],
            ['name' => 'Star Ferry Ride', 'destination' => 'Hong Kong', 'rating' => 4.7, 'reviews' => 18000, 'price' => 5.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/crxhfc2h6yzo5npu065l.jpg', 'is_active' => true],
            ['name' => 'Hong Kong Disneyland', 'destination' => 'Hong Kong', 'rating' => 9.0, 'reviews' => 30000, 'price' => 80.00, 'original_price' => 100.00, 'discount_text' => '20% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Hong_Kong_Disneyland_Castle.jpg/1280px-Hong_Kong_Disneyland_Castle.jpg', 'is_active' => true],
            
            // Kuala Lumpur
            ['name' => 'Petronas Twin Towers', 'destination' => 'Kuala Lumpur', 'rating' => 4.7, 'reviews' => 30000, 'price' => 20.00, 'original_price' => 30.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/0b/1a/85/e4.jpg', 'is_active' => true],
            ['name' => 'Batu Caves Tour', 'destination' => 'Kuala Lumpur', 'rating' => 4.5, 'reviews' => 15000, 'price' => 10.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/pd7oxi6yz21dwtql57bp.jpg', 'is_active' => true],
            ['name' => 'KL Tower Observation Deck', 'destination' => 'Kuala Lumpur', 'rating' => 4.6, 'reviews' => 20000, 'price' => 15.00, 'original_price' => 25.00, 'discount_text' => '40% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.discoverasr.com/content/dam/tal/media/images/destinations/malaysia/Malaysia-City.jpg', 'is_active' => true],
            
            // Johor Bahru
            ['name' => 'Legoland Malaysia', 'destination' => 'Johor Bahru', 'rating' => 4.5, 'reviews' => 25000, 'price' => 50.00, 'original_price' => 70.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.kkday.com/en/blog/wp-content/uploads/featured_legoland.jpg', 'is_active' => true],
            ['name' => 'Hello Kitty Town', 'destination' => 'Johor Bahru', 'rating' => 4.3, 'reviews' => 15000, 'price' => 30.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/07/02/27/2e.jpg', 'is_active' => true],
            ['name' => 'Johor Bahru City Tour', 'destination' => 'Johor Bahru', 'rating' => 4.0, 'reviews' => 5000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/09/20/09/f2.jpg', 'is_active' => true],
            
            // Guangzhou
            ['name' => 'Canton Tower Entry', 'destination' => 'Guangzhou', 'rating' => 4.5, 'reviews' => 20000, 'price' => 15.00, 'original_price' => 25.00, 'discount_text' => '40% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.chinadiscovery.com/assets/images/travel-guide/guangzhou/canton-tower/canton-tower-768-7.jpg', 'is_active' => true],
            ['name' => 'Shamian Island Tour', 'destination' => 'Guangzhou', 'rating' => 4.4, 'reviews' => 15000, 'price' => 10.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://www.thechinaguide.com/uploads/201806/23/5b2e295c4e173.jpg', 'is_active' => true],
            ['name' => 'Guangzhou Opera House', 'destination' => 'Guangzhou', 'rating' => 4.6, 'reviews' => 5000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://www.webuildvalue.com/wp-content/uploads/2020/12/Guangzhou-Opera-House-night-landscape.jpg', 'is_active' => true],
            
            // Shanghai
            ['name' => 'Shanghai Tower Observation Deck', 'destination' => 'Shanghai', 'rating' => 4.7, 'reviews' => 25000, 'price' => 20.00, 'original_price' => 30.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/e0/c2/c7.jpg', 'is_active' => true],
            ['name' => 'The Bund River Cruise', 'destination' => 'Shanghai', 'rating' => 4.5, 'reviews' => 15000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://asiantrails.b-cdn.net/wp-content/uploads/2021/11/china-shanghai-river-cruise-city-lights.jpg', 'is_active' => true],
            ['name' => 'Yu Garden Entry', 'destination' => 'Shanghai', 'rating' => 4.6, 'reviews' => 20000, 'price' => 10.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://ltl-shanghai.com/wp-content/sites/12/2023/03/garden_optimized-1280x720.jpg', 'is_active' => true],
            
            // Chongqing
            ['name' => 'Chongqing Cable Car', 'destination' => 'Chongqing', 'rating' => 4.5, 'reviews' => 20000, 'price' => 10.00, 'original_price' => 15.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://www.topchinatravel.com/pic/city/chongqing/attrations/changjiang-ropeway-2.jpg', 'is_active' => true],
            ['name' => 'Dazu Rock Carvings Tour', 'destination' => 'Chongqing', 'rating' => 4.4, 'reviews' => 15000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/07/af/8b/38.jpg', 'is_active' => true],
            ['name' => 'Chongqing Zoo Panda Exhibit', 'destination' => 'Chongqing', 'rating' => 4.6, 'reviews' => 5000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://www.chinadiscovery.com/assets/images/travel-guide/chongqing/chongqing-zoo/pandas-in-chongqing-banner.jpg', 'is_active' => true],
            
            // South Korea
            ['name' => 'Gyeongbokgung Palace Tour', 'destination' => 'South Korea', 'rating' => 4.7, 'reviews' => 25000, 'price' => 20.00, 'original_price' => 30.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://www.agoda.com/wp-content/uploads/2019/05/Gyeongbokgung-palace-Seoul-Throne-Hall.jpg', 'is_active' => true],
            ['name' => 'N Seoul Tower Entry', 'destination' => 'South Korea', 'rating' => 4.5, 'reviews' => 15000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://static.wixstatic.com/media/0505b9_f420aceac3b942db958ecf64a43d1762~mv2.jpg/v1/fill/w_922,h_691,al_c,q_85,enc_avif,quality_auto/0505b9_f420aceac3b942db958ecf64a43d1762~mv2.jpg', 'is_active' => true],
            ['name' => 'Bukchon Hanok Village Tour', 'destination' => 'South Korea', 'rating' => 4.6, 'reviews' => 20000, 'price' => 10.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://southkoreahallyu.com/wp-content/uploads/2025/08/bukchon-3.jpg', 'is_active' => true],
            
            // Iceland
            ['name' => 'Blue Lagoon Entry', 'destination' => 'Iceland', 'rating' => 4.8, 'reviews' => 30000, 'price' => 50.00, 'original_price' => 70.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://www.wheretonexttravelblog.com/wp-content/uploads/2017/02/blue-lagoon-to-cieland-entrance-path.jpg', 'is_active' => true],
            ['name' => 'Golden Circle Tour', 'destination' => 'Iceland', 'rating' => 4.7, 'reviews' => 25000, 'price' => 80.00, 'original_price' => 100.00, 'discount_text' => '20% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://media.tacdn.com/media/attractions-splice-spp-674x446/06/71/b1/9b.jpg', 'is_active' => true],
            ['name' => 'Reykjavik City Tour', 'destination' => 'Iceland', 'rating' => 4.6, 'reviews' => 20000, 'price' => 30.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://cdn.prod.website-files.com/5d0390443011830c49612c3c/5d931a091ab8d86e4e8f3d2a_Private%20city%20Tour.jpg', 'is_active' => true],
            ['name' => 'Northern Lights Tour', 'destination' => 'Iceland', 'rating' => 4.9, 'reviews' => 15000, 'price' => 100.00, 'original_price' => 150.00, 'discount_text' => '33% off', 'booking_text' => 'Limited availability', 'image_url' => 'https://res.klook.com/image/upload/w_750,h_469,c_fill,q_85/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/ivdlepfxdwg36ycnuxdd.jpg', 'is_active' => true],
            
            // Hokkaido
            ['name' => 'Sapporo Snow Festival Tour', 'destination' => 'Hokkaido', 'rating' => 4.8, 'reviews' => 20000, 'price' => 60.00, 'original_price' => 80.00, 'discount_text' => '25% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://cdn.gaijinpot.com/app/uploads/sites/6/2018/02/Sapporo-1.jpg', 'is_active' => true],
            ['name' => 'Otaru Canal Cruise', 'destination' => 'Hokkaido', 'rating' => 4.7, 'reviews' => 15000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://rimage.gnst.jp/livejapan.com/public/article/detail/a/10/00/a1000323/img/basic/a1000323_main.jpg', 'is_active' => true],
            ['name' => 'Niseko Ski Resort Pass', 'destination' => 'Hokkaido', 'rating' => 4.9, 'reviews' => 5000, 'price' => 100.00, 'original_price' => 150.00, 'discount_text' => '33% off', 'booking_text' => 'Limited availability', 'image_url' => 'https://rhythmjapan.com/getmedia/f49c20f6-a56d-4e22-8ae0-2f34571d8a6b/smallScenicHighlights23-24_IP-5306.jpg', 'is_active' => true],
            ['name' => 'Asahiyama Zoo Entry', 'destination' => 'Hokkaido', 'rating' => 4.6, 'reviews' => 20000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://hokkaido.a4jp.com/wp-content/uploads/2021/08/hokkaido-asahiyama-zoo-ticket-1140x712.jpg', 'is_active' => true],
            ['name' => 'Shiretoko National Park Tour', 'destination' => 'Hokkaido', 'rating' => 4.8, 'reviews' => 15000, 'price' => 80.00, 'original_price' => 100.00, 'discount_text' => '20% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://www.wanderingsneakers.com/wp-content/uploads/2018/12/shiretoko13.jpg', 'is_active' => true],
            
            // Chiang Mai
            ['name' => 'Doi Suthep Temple Tour', 'destination' => 'Chiang Mai', 'rating' => 4.7, 'reviews' => 25000, 'price' => 20.00, 'original_price' => 30.00, 'discount_text' => '33% off', 'booking_text' => 'Skip the line', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg', 'is_active' => true],
            ['name' => 'Elephant Sanctuary Visit', 'destination' => 'Chiang Mai', 'rating' => 4.8, 'reviews' => 15000, 'price' => 50.00, 'original_price' => 70.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://www.elephantnaturepark.org/wp-content/uploads/2025/10/ENP_SkyWalk_Visit_2L.jpg', 'is_active' => true],
            ['name' => 'Chiang Mai Night Bazaar Tour', 'destination' => 'Chiang Mai', 'rating' => 4.6, 'reviews' => 20000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://www.vivutravel.com/images/des-thailand1/chiang-mai-night-market.jpg', 'is_active' => true],
            
            // Sabah
            ['name' => 'Kinabalu Park Tour', 'destination' => 'Sabah', 'rating' => 4.8, 'reviews' => 20000, 'price' => 30.00, 'original_price' => 50.00, 'discount_text' => '40% off', 'booking_text' => 'Book now for tomorrow', 'image_url' => 'https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_863/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/iffbqlczmcfmoe96sh2l/KinabaluParkPoringHotSpringTour.jpg', 'is_active' => true],
            ['name' => 'Sipadan Island Diving', 'destination' => 'Sabah', 'rating' => 4.9, 'reviews' => 15000, 'price' => 100.00, 'original_price' => 150.00, 'discount_text' => '33% off', 'booking_text' => 'Limited availability', 'image_url' => 'https://seaventuresdive.com/wp-content/uploads/2021/11/Bg_faq-1200x799.jpg', 'is_active' => true],
            ['name' => 'Sabah Wildlife Rescue Center', 'destination' => 'Sabah', 'rating' => 4.6, 'reviews' => 20000, 'price' => 15.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://mlbq5rotgc8n.i.optimole.com/39b2ZwQ-a_KVV7aw/w:auto/h:auto/q:mauto/f:avif/https://www.stickyricetravel.com/wp-content/uploads/elementor/thumbs/sepilok-1500-1-nupr8yar36oxwovzy1coivaf539cncowklyhn1n1u8.jpg', 'is_active' => true],
            ['name' => 'Poring Hot Springs Entry', 'destination' => 'Sabah', 'rating' => 4.7, 'reviews' => 15000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://travelynnfamily.com/wp-content/uploads/2023/09/Poring-Hot-Springs-3-1024x731.jpg', 'is_active' => true],
            
            // Vietnam (added)
            ['name' => 'Halong Bay Cruise', 'destination' => 'Vietnam', 'rating' => 4.8, 'reviews' => 20000, 'price' => 50.00, 'original_price' => 70.00, 'discount_text' => '28% off', 'booking_text' => 'Book now for today', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg', 'is_active' => true],
            ['name' => 'Hanoi Old Quarter Walking Tour', 'destination' => 'Vietnam', 'rating' => 4.7, 'reviews' => 15000, 'price' => 20.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Immediate access', 'image_url' => 'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/09/7a/f3/79.jpg', 'is_active' => true],
            ['name' => 'Ho Chi Minh City Food Tour', 'destination' => 'Vietnam', 'rating' => 4.6, 'reviews' => 20000, 'price' => 30.00, 'original_price' => null, 'discount_text' => null, 'booking_text' => 'Book now for today', 'image_url' => 'https://www.vivutravel.com/images/des-vietnam1/ho-chi-minh-city-food-tour.jpg', 'is_active' => true],
        ];

        $descriptionMap = [
            'Waterbom Bali' => 'Experience the ultimate water park adventure at Waterbom Bali, with thrilling slides, palm-fringed pools, and a splash zone made for every age.',
            'Penida Island' => 'Explore rugged cliffs, turquoise lagoons, and iconic coastal views on Penida Island, where every photo moment feels like paradise.',
            'Ubud Palace' => 'Step into the royal courtyard of Ubud Palace and discover ancient Balinese architecture, sacred shrines, and cultural performances.',
            'Ayung River Rafting' => 'Take on Ayung River’s rapid waters, lush canyon scenery, and cascading waterfalls for a white-water rafting adventure in Bali.',
            'Tokyo Disneyland' => 'Journey through a magical Disney kingdom in Tokyo, where famous attractions, parades, and fantasy-filled lands await visitors of all ages.',
            'Shibuya Sky Observation' => 'Rise above the neon lights at Shibuya Sky and gaze over Tokyo’s skyline from one of the city’s most dramatic observation decks.',
            'Senso-ji Temple Tour' => 'Visit the vibrant Senso-ji Temple district, wander past paper lanterns and souvenir stalls, and discover Tokyo’s oldest spiritual landmark.',
            'Tokyo Tower Entry' => 'Ascend the iconic Tokyo Tower for sweeping city views, dazzling illuminations, and a timeless Tokyo experience.',
            'Eiffel Tower Summit Access' => 'Climb to the summit of the Eiffel Tower and savor breathtaking views across Paris, from the Seine to the Champs-Élysées.',
            'Louvre Museum Fast Track' => 'Skip the line at the Louvre and enjoy fast access to world-famous art, including the Mona Lisa, Venus de Milo, and Egyptian antiquities.',
            'Maldives Snorkeling Adventure' => 'Dive into the Maldives’ crystal-clear lagoons and swim among vibrant coral reefs, tropical fish, and sea turtles.',
            'Maldives Sunset Cruise' => 'Relax on a romantic sunset cruise in the Maldives, complete with palm-fringed atolls, golden skies, and sparkling ocean views.',
            'George Town Street Art Tour' => 'Discover Penang’s colorful street murals, hidden alleyways, and historic architecture on a guided George Town art walk.',
            'Penang Hill Funicular' => 'Ride the funicular railway to Penang Hill and enjoy cool breezes, panoramic views, and colonial-era charm at the top.',
            'Penang Botanic Gardens' => 'Wander through the tranquil Penang Botanic Gardens, home to tropical plants, winding paths, and peaceful garden vistas.',
            'Penang Street Food Tour' => 'Taste Penang’s famous street dishes on a guided food tour, from char kway teow to assam laksa and cendol delights.',
            'Langkawi Sky Bridge' => 'Walk across the Langkawi Sky Bridge and marvel at breathtaking views over rainforest canopy and limestone peaks.',
            'Island Hopping Tour' => 'Explore Langkawi’s emerald islands, hidden beaches, and natural lagoons on a scenic island hopping adventure.',
            'Grand Palace Tour' => 'Discover Bangkok’s Grand Palace, golden temples, and ornate architecture in the city’s most iconic royal complex.',
            'River Cruise Dinner' => 'Dine aboard a luxurious river cruise on the Chao Phraya, taking in glittering temples and city lights as you glide through Bangkok.',
            'Gardens by the Bay' => 'Marvel at Singapore’s futuristic gardens, giant Supertrees, and spectacular floral displays at Gardens by the Bay.',
            'Universal Studios Singapore' => 'Experience thrilling rides, live shows, and movie-themed attractions at Universal Studios Singapore.',
            'Singapore Flyer' => 'Take a ride on the Singapore Flyer and enjoy panoramic city views from one of the world’s tallest observation wheels.',
            'Victoria Peak Tram' => 'Ride the famous Peak Tram up to Victoria Peak and enjoy spectacular views over Hong Kong’s skyline and harbor.',
            'Star Ferry Ride' => 'Cross Victoria Harbour on the historic Star Ferry for a classic Hong Kong experience with stunning city views.',
            'Hong Kong Disneyland' => 'Enter a fairy-tale kingdom at Hong Kong Disneyland, complete with magical entertainment, themed lands, and family fun.',
            'Petronas Twin Towers' => 'Visit the Petronas Twin Towers for impressive architecture, skybridge access, and views across Kuala Lumpur’s skyline.',
            'Batu Caves Tour' => 'Explore Batu Caves’ towering limestone caverns, vibrant shrine, and dramatic steps to a sacred Hindu temple.',
            'KL Tower Observation Deck' => 'Enjoy panoramic city views from KL Tower’s observation deck, with the Petronas Towers shining in the distance.',
            'Legoland Malaysia' => 'Enjoy family fun at Legoland Malaysia, with interactive rides, water attractions, and LEGO-themed entertainment.',
            'Hello Kitty Town' => 'Step into the adorable world of Hello Kitty Town for colorful attractions, cute displays, and family-friendly fun.',
            'Johor Bahru City Tour' => 'Explore Johor Bahru’s cultural landmarks, bustling markets, and local heritage on a guided city tour.',
            'Canton Tower Entry' => 'Ride up Canton Tower for sweeping city views, sky-high lights, and an iconic Guangzhou landmark.',
            'Shamian Island Tour' => 'Stroll through historic Shamian Island, with colonial architecture, riverside promenades, and tranquil streets.',
            'Guangzhou Opera House' => 'Visit the futuristic Guangzhou Opera House for a dramatic architectural experience and cultural performances.',
            'Shanghai Tower Observation Deck' => 'Look down from Shanghai Tower’s observation deck and see the city’s futuristic skyline stretch to the horizon.',
            'The Bund River Cruise' => 'Relax on a Bund river cruise and admire Shanghai’s illuminated skyscrapers, historic waterfront, and riverfront charm.',
            'Yu Garden Entry' => 'Enter Yu Garden for classic Chinese landscaping, ornate pavilions, and a peaceful oasis in Shanghai’s old city.',
            'Chongqing Cable Car' => 'Take the Chongqing Cable Car over the Yangtze River for unforgettable views of the city and dramatic riverside cliffs.',
            'Dazu Rock Carvings Tour' => 'See the ancient Dazu Rock Carvings up close and explore exquisite Buddhist sculptures carved into cliff faces.',
            'Chongqing Zoo Panda Exhibit' => 'Visit Chongqing Zoo’s panda exhibit and see these lovable giants in a lush, family-friendly wildlife setting.',
            'Gyeongbokgung Palace Tour' => 'Experience the grandeur of Gyeongbokgung Palace with royal architecture, palace gardens, and traditional guard changing ceremonies.',
            'N Seoul Tower Entry' => 'Ride to N Seoul Tower for panoramic views of Seoul, romantic lighting, and a sky-high observation experience.',
            'Bukchon Hanok Village Tour' => 'Wander Bukchon Hanok Village’s traditional Korean houses, narrow alleys, and cultural heritage in the heart of Seoul.',
            'Blue Lagoon Entry' => 'Relax in Iceland’s famous Blue Lagoon, soaking in milky blue geothermal waters surrounded by dramatic volcanic landscapes.',
            'Golden Circle Tour' => 'See Iceland’s natural wonders on the Golden Circle, including geysers, waterfalls, and the rift valley of Þingvellir National Park.',
            'Reykjavik City Tour' => 'Discover Iceland’s vibrant capital with a guided Reykjavik tour covering landmarks, local culture, and coastal views.',
            'Northern Lights Tour' => 'Chase the Northern Lights in Iceland on a nighttime tour, watching the aurora dance across crisp Arctic skies.',
            'Sapporo Snow Festival Tour' => 'Explore the magical snow sculptures and winter attractions of the Sapporo Snow Festival in Hokkaido.',
            'Otaru Canal Cruise' => 'Drift along Otaru Canal and admire charming warehouses, historic bridges, and serene waterfront scenery.',
            'Niseko Ski Resort Pass' => 'Hit Niseko’s famous slopes with a ski pass for world-class powder, mountain vistas, and winter resort thrills.',
            'Asahiyama Zoo Entry' => 'Visit Asahiyama Zoo for close-up wildlife experiences, penguin parades, and innovative animal viewing exhibits.',
            'Shiretoko National Park Tour' => 'Explore Shiretoko National Park’s pristine wilderness, rugged coastline, and abundant wildlife on a guided tour.',
            'Doi Suthep Temple Tour' => 'Climb to Doi Suthep Temple and take in breathtaking mountain views, golden pagodas, and sacred temple grounds.',
            'Elephant Sanctuary Visit' => 'Visit an ethical elephant sanctuary near Chiang Mai and learn about rescue efforts while meeting gentle giants.',
            'Chiang Mai Night Bazaar Tour' => 'Experience Chiang Mai’s Night Bazaar with lantern-lit stalls, local handicrafts, and delicious street food.',
            'Kinabalu Park Tour' => 'Explore Kinabalu Park’s mountain trails, cloud forests, and scenic views beneath Malaysia’s highest peak.',
            'Sipadan Island Diving' => 'Dive Sipadan Island’s world-renowned waters for turtles, reef sharks, and spectacular marine biodiversity.',
            'Sabah Wildlife Rescue Center' => 'See rescued wildlife at Sabah Wildlife Rescue Center and learn about conservation efforts in Borneo’s rainforests.',
            'Poring Hot Springs Entry' => 'Unwind in Poring Hot Springs with soothing geothermal pools, canopy walks, and jungle scenery in Sabah.',
            'Halong Bay Cruise' => 'Sail through Halong Bay’s emerald waters, limestone karsts, and hidden caves on a scenic overnight cruise.',
            'Hanoi Old Quarter Walking Tour' => 'Wander Hanoi’s historic Old Quarter, tasting local coffee and exploring narrow streets lined with centuries-old shops.',
            'Ho Chi Minh City Food Tour' => 'Sample the best of Ho Chi Minh City street cuisine on a guided food tour through vibrant markets and local eateries.',
        ];

        foreach ($attractions as $attr) {
            $dest = Destination::where('name', $attr['destination'])->first();
            if ($dest) {
                $existing = Attraction::where('name', $attr['name'])
                    ->where('destination_id', $dest->id)
                    ->first();

                if (!array_key_exists('description', $attr) || $attr['description'] === null) {
                    $attr['description'] = $descriptionMap[$attr['name']] ?? null;
                }

                if (empty($attr['description']) && $existing && $existing->description) {
                    $attr['description'] = $existing->description;
                }

                if (empty($attr['description'])) {
                    $attr['description'] = "Discover {$attr['name']} in {$attr['destination']}. Book now to enjoy the best of {$attr['destination']}";
                }

                Attraction::updateOrCreate(
                    [
                        'name' => $attr['name'],
                        'destination_id' => $dest->id,
                    ],
                    [
                        'rating' => $attr['rating'],
                        'reviews' => $attr['reviews'],
                        'price' => $attr['price'],
                        'original_price' => $attr['original_price'],
                        'discount_text' => $attr['discount_text'],
                        'booking_text' => $attr['booking_text'],
                        'image_url' => $attr['image_url'],
                        'is_active' => $attr['is_active'],
                        'description' => $attr['description'],
                    ]
                );
            }
        }
    }
}