<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('flights')->truncate();

        // Airport codes (IATA) for 20 destinations
        $airports = [
            'KUL' => 'Kuala Lumpur',
            'PEN' => 'Penang',
            'LGK' => 'Langkawi',
            'BKK' => 'Bangkok',
            'SIN' => 'Singapore',
            'DPS' => 'Bali',
            'NRT' => 'Tokyo',
            'CDG' => 'Paris',
            'HKG' => 'Hong Kong',
            'MLE' => 'Maldives',
            'JHB' => 'Johor Bahru',
            'CAN' => 'Guangzhou',
            'PVG' => 'Shanghai',
            'CKG' => 'Chongqing',
            'HAN' => 'Vietnam (Hanoi)',
            'ICN' => 'South Korea (Seoul)',
            'CTS' => 'Hokkaido (Sapporo)',
            'CNX' => 'Chiang Mai',
            'BKI' => 'Sabah (Kota Kinabalu)',
        ];

        // Generate all possible routes (origin != destination)
        $airportCodes = array_keys($airports);
        $routes = [];
        foreach ($airportCodes as $origin) {
            foreach ($airportCodes as $dest) {
                if ($origin !== $dest) {
                    $routes[] = ['origin' => $origin, 'destination' => $dest];
                }
            }
        }

        // Durations (approximate flight times in hours:minutes)
        // We'll define a helper function to estimate duration based on distance categories
        // For simplicity, we'll use a lookup array for common pairs; for others, calculate based on typical flight times.
        // But to keep it manageable, we'll manually define durations for all routes? That's 380 routes.
        // Instead, we'll generate dynamically using distance categories.

        // Base durations between regions (in minutes) – you can refine later
        $durationsMinutes = [];
        foreach ($routes as $route) {
            $origin = $route['origin'];
            $dest = $route['destination'];

            // Categorise airports by region
            $regions = [
                'SEA' => ['KUL', 'PEN', 'LGK', 'SIN', 'JHB', 'BKI', 'DPS', 'CNX', 'BKK', 'HAN'], // South East Asia
                'EA'  => ['HKG', 'CAN', 'PVG', 'CKG', 'ICN', 'NRT', 'CTS'], // East Asia
                'SA'  => ['MLE'], // South Asia (Maldives)
                'EU'  => ['CDG'], // Europe
            ];

            $regionOf = function($code) use ($regions) {
                foreach ($regions as $region => $codes) {
                    if (in_array($code, $codes)) return $region;
                }
                return 'SEA'; // default
            };

            $reg1 = $regionOf($origin);
            $reg2 = $regionOf($dest);

            // Define flight minutes between regions
            $regionTimes = [
                'SEA-SEA' => 90,   // 1.5h
                'SEA-EA'  => 300,  // 5h
                'SEA-SA'  => 270,  // 4.5h
                'SEA-EU'  => 780,  // 13h
                'EA-EA'   => 150,  // 2.5h
                'EA-SA'   => 420,  // 7h
                'EA-EU'   => 660,  // 11h
                'SA-EU'   => 600,  // 10h
                'SA-SA'   => 120,  // 2h
                'EU-EU'   => 120,  // 2h (not used much)
            ];

            $key = $reg1 . '-' . $reg2;
            $minutes = $regionTimes[$key] ?? 300; // default 5h
            $durationsMinutes[$origin . '-' . $dest] = $minutes;
        }

        // Price ranges (economy, MYR) – we'll generate based on duration
        $priceRanges = [];
        foreach ($routes as $route) {
            $origin = $route['origin'];
            $dest = $route['destination'];
            $minutes = $durationsMinutes[$origin . '-' . $dest];
            // Price roughly RM 1.5 per minute? adjust
            $base = round($minutes * 1.2);
            $minPrice = max(80, $base - 50);
            $maxPrice = $base + 100;
            $priceRanges[$origin . '-' . $dest] = [$minPrice, $maxPrice];
        }

        // Airlines list (mix of local and international)
        $airlines = [
            'Malaysia Airlines', 'AirAsia', 'Firefly', 'Batik Air', 'Scoot',
            'China Southern', 'Thai Airways', 'Singapore Airlines', 'Cathay Pacific',
            'Japan Airlines', 'Garuda Indonesia', 'Korean Air', 'EVA Air',
            'Vietnam Airlines', 'Air France', 'Emirates', 'Qatar Airways'
        ];

        $baggageMap = [
            'Malaysia Airlines' => 'Checked 20 kg',
            'AirAsia' => 'Cabin only',
            'Firefly' => 'Checked 15 kg',
            'Batik Air' => 'Checked 20 kg',
            'Scoot' => 'Checked 20 kg',
            'China Southern' => 'Checked 23 kg',
            'Thai Airways' => 'Checked 30 kg',
            'Singapore Airlines' => 'Checked 25 kg',
            'Cathay Pacific' => 'Checked 30 kg',
            'Japan Airlines' => 'Checked 2x23 kg',
            'Garuda Indonesia' => 'Checked 20 kg',
            'Korean Air' => 'Checked 23 kg',
            'EVA Air' => 'Checked 30 kg',
            'Vietnam Airlines' => 'Checked 20 kg',
            'Air France' => 'Checked 23 kg',
            'Emirates' => 'Checked 30 kg',
            'Qatar Airways' => 'Checked 25 kg',
        ];

        $departureTimes = [
            '06:00:00', '07:30:00', '09:00:00', '10:30:00', '12:00:00',
            '13:30:00', '15:00:00', '16:30:00', '18:00:00', '19:30:00',
            '21:00:00', '22:30:00'
        ];

        $now = now();
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);
        $flights = [];

        // Class configurations
        $classes = [
            'economy'  => ['multiplier' => 1,   'baggage' => null,          'chance' => 100, 'minSeats' => 10, 'maxSeats' => 120, 'numFlights' => 5],
            'premium'  => ['multiplier' => 2,   'baggage' => 'Checked 25 kg','chance' => 80,  'minSeats' => 5,  'maxSeats' => 30,  'numFlights' => 2],
            'business' => ['multiplier' => 3.5, 'baggage' => 'Checked 30 kg + Lounge','chance' => 60, 'minSeats' => 3,  'maxSeats' => 20, 'numFlights' => 2],
            'first'    => ['multiplier' => 5,   'baggage' => 'Checked 2x32 kg + First Lounge','chance' => 30, 'minSeats' => 2, 'maxSeats' => 12, 'numFlights' => 1],
        ];

        foreach ($routes as $route) {
            $origin = $route['origin'];
            $dest = $route['destination'];
            $routeKey = $origin . '-' . $dest;

            if (!isset($durationsMinutes[$routeKey]) || !isset($priceRanges[$routeKey])) {
                continue;
            }

            $minutes = $durationsMinutes[$routeKey];
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;
            $duration = ($hours > 0 ? $hours . 'h ' : '') . $mins . 'm';
            $priceMin = $priceRanges[$routeKey][0];
            $priceMax = $priceRanges[$routeKey][1];

            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $departureDate = $date->toDateString();

                foreach ($classes as $class => $config) {
                    // Determine number of flights for this class on this day
                    if ($class === 'economy') {
                        $numFlights = $config['numFlights'];
                    } else {
                        if (rand(1, 100) > $config['chance']) continue;
                        $numFlights = rand(1, $config['numFlights']);
                    }

                    for ($i = 0; $i < $numFlights; $i++) {
                        $airline = $airlines[array_rand($airlines)];
                        $departureTime = $departureTimes[array_rand($departureTimes)];
                        $arrivalTime = $this->addMinutesToTime($departureTime, $minutes);
                        $price = round(rand($priceMin, $priceMax) * $config['multiplier'], -1);
                        $availableSeats = rand($config['minSeats'], $config['maxSeats']);
                        $baggage = $config['baggage'] ?? ($baggageMap[$airline] ?? 'Checked 20 kg');
                        $originTerminal = 'T' . rand(1, 3);
                        $destTerminal = 'T' . rand(1, 3);

                        $flights[] = [
                            'origin' => $origin,
                            'destination' => $dest,
                            'departure_date' => $departureDate,
                            'departure_time' => $departureTime,
                            'arrival_time' => $arrivalTime,
                            'airline' => $airline,
                            'cabin_class' => $class,
                            'price' => $price,
                            'available_seats' => $availableSeats,
                            'duration' => $duration,
                            'origin_terminal' => $originTerminal,
                            'destination_terminal' => $destTerminal,
                            'baggage' => $baggage,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            }
        }

        // Insert in chunks
        $chunks = array_chunk($flights, 500);
        foreach ($chunks as $chunk) {
            DB::table('flights')->insert($chunk);
        }
    }

    private function addMinutesToTime($time, $minutesToAdd)
    {
        $parts = explode(':', $time);
        $hours = (int)$parts[0];
        $minutes = (int)$parts[1];

        $totalMinutes = $hours * 60 + $minutes + $minutesToAdd;
        $newHours = floor($totalMinutes / 60) % 24;
        $newMinutes = $totalMinutes % 60;
        return sprintf('%02d:%02d:00', $newHours, $newMinutes);
    }
}