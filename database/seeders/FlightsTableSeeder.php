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

        // Airport codes for the 20 destinations (IATA)
        $airports = [
            'Kuala Lumpur' => 'KUL',
            'Penang'       => 'PEN',
            'Langkawi'     => 'LGK',
            'Bangkok'      => 'BKK',
            'Singapore'    => 'SIN',
            'Bali'         => 'DPS',
            'Tokyo'        => 'NRT',
            'Paris'        => 'CDG',
            'Hong Kong'    => 'HKG',
            'Maldives'     => 'MLE',
            'Johor Bahru'  => 'JHB',
            'Guangzhou'    => 'CAN',
            'Shanghai'     => 'PVG',
            'Chongqing'    => 'CKG',
            'Vietnam'      => 'HAN',
            'South Korea'  => 'ICN',
            'Iceland'      => 'KEF',
            'Hokkaido'     => 'CTS',
            'Chiang Mai'   => 'CNX',
            'Sabah'        => 'BKI',
        ];

        $airportCodes = array_values($airports);
        $routes = [];

        // Generate all possible routes (origin != destination)
        foreach ($airportCodes as $origin) {
            foreach ($airportCodes as $dest) {
                if ($origin !== $dest) {
                    $routes[] = ['origin' => $origin, 'destination' => $dest];
                }
            }
        }

        // Helper to get region for duration/price estimation
        $regionOf = function($code) {
            $regions = [
                'SEA' => ['KUL', 'PEN', 'LGK', 'JHB', 'BKI', 'SIN', 'BKK', 'DPS', 'CNX', 'HAN'],
                'EA'  => ['CAN', 'PVG', 'CKG', 'HKG', 'ICN', 'NRT', 'CTS'],
                'SA'  => ['MLE'],
                'EU'  => ['CDG', 'KEF'],
            ];
            foreach ($regions as $region => $codes) {
                if (in_array($code, $codes)) return $region;
            }
            return 'SEA';
        };

        // Durations in minutes between regions
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
            'EU-EU'   => 120,  // 2h
        ];

        // Store durations and price ranges per route
        $durationsMinutes = [];
        $priceRanges = [];
        foreach ($routes as $route) {
            $origin = $route['origin'];
            $dest = $route['destination'];
            $reg1 = $regionOf($origin);
            $reg2 = $regionOf($dest);
            $key = $reg1 . '-' . $reg2;
            $minutes = $regionTimes[$key] ?? 300; // default 5h
            $durationsMinutes[$origin . '-' . $dest] = $minutes;

            // Price per adult (MYR) – roughly RM 1.5 per minute for economy
            $base = round($minutes * 1.2);
            $minPrice = max(80, $base - 50);
            $maxPrice = $base + 100;
            $priceRanges[$origin . '-' . $dest] = [$minPrice, $maxPrice];
        }

        $airlines = [
            'Malaysia Airlines', 'AirAsia', 'Firefly', 'Batik Air', 'Scoot',
            'China Southern', 'Thai Airways', 'Singapore Airlines', 'Cathay Pacific',
            'Japan Airlines', 'Garuda Indonesia', 'Korean Air', 'EVA Air',
            'Vietnam Airlines', 'Air France', 'Emirates', 'Qatar Airways', 'Icelandair'
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
            'Icelandair' => 'Checked 23 kg',
        ];

        $departureTimes = [
            '06:00:00', '07:30:00', '09:00:00', '10:30:00', '12:00:00',
            '13:30:00', '15:00:00', '16:30:00', '18:00:00', '19:30:00',
            '21:00:00', '22:30:00'
        ];

        $now = now();
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(15);
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
        $chunks = array_chunk($flights, 1000);
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