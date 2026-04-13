<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('flights')->truncate();

        // Define routes (origin, destination) – added more countries
        $routes = [
            // Existing Malaysian routes
            ['origin' => 'KUL', 'destination' => 'CAN'], // Kuala Lumpur → Guangzhou
            ['origin' => 'KUL', 'destination' => 'PEN'], // Kuala Lumpur → Penang
            ['origin' => 'KUL', 'destination' => 'JHB'], // Kuala Lumpur → Johor Bahru
            ['origin' => 'PEN', 'destination' => 'KUL'], // Penang → Kuala Lumpur
            ['origin' => 'KUL', 'destination' => 'LGK'], // Kuala Lumpur → Langkawi

            // New international routes (from Kuala Lumpur)
            ['origin' => 'KUL', 'destination' => 'SIN'], // Kuala Lumpur → Singapore
            ['origin' => 'KUL', 'destination' => 'BKK'], // Kuala Lumpur → Bangkok
            ['origin' => 'KUL', 'destination' => 'HKG'], // Kuala Lumpur → Hong Kong
            ['origin' => 'KUL', 'destination' => 'NRT'], // Kuala Lumpur → Tokyo (Narita)
            ['origin' => 'KUL', 'destination' => 'DPS'], // Kuala Lumpur → Bali (Denpasar)

            // Return routes (for round trips)
            ['origin' => 'SIN', 'destination' => 'KUL'], // Singapore → Kuala Lumpur
            ['origin' => 'BKK', 'destination' => 'KUL'], // Bangkok → Kuala Lumpur
            ['origin' => 'HKG', 'destination' => 'KUL'], // Hong Kong → Kuala Lumpur
            ['origin' => 'NRT', 'destination' => 'KUL'], // Tokyo → Kuala Lumpur
            ['origin' => 'DPS', 'destination' => 'KUL'], // Bali → Kuala Lumpur
        ];

        // Airlines for each route (mix of full-service and low-cost)
        $airlines = [
            'Malaysia Airlines',
            'AirAsia',
            'Firefly',
            'Batik Air',
            'Scoot',
            'China Southern',
            'Thai Airways',
            'Singapore Airlines',
            'Cathay Pacific',
            'Japan Airlines',
            'Garuda Indonesia',
        ];

        // Departure times (24h format) – spread across the day
        $departureTimes = [
            '06:00:00', '07:30:00', '09:00:00', '10:30:00', '12:00:00',
            '13:30:00', '15:00:00', '16:30:00', '18:00:00', '19:30:00',
            '21:00:00', '22:30:00'
        ];

        // Durations per route (approx) – added for new routes
        $durations = [
            // Existing
            'KUL-CAN' => '4h 15m',
            'KUL-PEN' => '55m',
            'KUL-JHB' => '1h',
            'PEN-KUL' => '55m',
            'KUL-LGK' => '1h',
            // New
            'KUL-SIN' => '1h 10m',
            'KUL-BKK' => '2h 15m',
            'KUL-HKG' => '3h 45m',
            'KUL-NRT' => '7h 00m',
            'KUL-DPS' => '3h 00m',
            // Returns
            'SIN-KUL' => '1h 10m',
            'BKK-KUL' => '2h 15m',
            'HKG-KUL' => '3h 45m',
            'NRT-KUL' => '7h 00m',
            'DPS-KUL' => '3h 00m',
        ];

        // Baggage info per airline (simplified)
        $baggageMap = [
            'Malaysia Airlines' => 'Checked baggage 20 kg',
            'AirAsia' => 'Cabin baggage only',
            'Firefly' => 'Checked baggage 15 kg',
            'Batik Air' => 'Checked baggage 20 kg',
            'Scoot' => 'Checked baggage 20 kg',
            'China Southern' => 'Checked baggage 23 kg',
            'Thai Airways' => 'Checked baggage 30 kg',
            'Singapore Airlines' => 'Checked baggage 25 kg',
            'Cathay Pacific' => 'Checked baggage 30 kg',
            'Japan Airlines' => 'Checked baggage 2 x 23 kg',
            'Garuda Indonesia' => 'Checked baggage 20 kg',
        ];

        // Price ranges per route (economy, in MYR) – added for new routes
        $priceRanges = [
            // Existing
            'KUL-CAN' => [800, 1600],
            'KUL-PEN' => [80, 150],
            'KUL-JHB' => [100, 180],
            'PEN-KUL' => [80, 150],
            'KUL-LGK' => [150, 250],
            // New
            'KUL-SIN' => [150, 350],
            'KUL-BKK' => [250, 550],
            'KUL-HKG' => [500, 1200],
            'KUL-NRT' => [1200, 2500],
            'KUL-DPS' => [400, 900],
            // Returns (similar to outbound)
            'SIN-KUL' => [150, 350],
            'BKK-KUL' => [250, 550],
            'HKG-KUL' => [500, 1200],
            'NRT-KUL' => [1200, 2500],
            'DPS-KUL' => [400, 900],
        ];

        $now = now();
        $startDate = Carbon::today(); // today
        $endDate = Carbon::today()->addDays(30); // next 30 days

        $flights = [];

        foreach ($routes as $route) {
            $origin = $route['origin'];
            $dest = $route['destination'];
            $routeKey = $origin . '-' . $dest;
            $duration = $durations[$routeKey];
            $priceMin = $priceRanges[$routeKey][0];
            $priceMax = $priceRanges[$routeKey][1];

            // For each date in range
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $departureDate = $date->toDateString();

                // Generate 5 economy flights per day (different airlines/times)
                for ($i = 0; $i < 5; $i++) {
                    // Pick a random airline (ensure variety)
                    $airline = $airlines[array_rand($airlines)];
                    $departureTime = $departureTimes[array_rand($departureTimes)];
                    // Calculate arrival time by adding duration (simplified: add minutes)
                    $arrivalTime = $this->addDurationToTime($departureTime, $duration);
                    $price = rand($priceMin, $priceMax);
                    $availableSeats = rand(10, 100);
                    $baggage = $baggageMap[$airline] ?? 'Checked baggage 20 kg';
                    $originTerminal = 'T' . rand(1, 2);
                    $destTerminal = 'T' . rand(1, 3);

                    $flights[] = [
                        'origin' => $origin,
                        'destination' => $dest,
                        'departure_date' => $departureDate,
                        'departure_time' => $departureTime,
                        'arrival_time' => $arrivalTime,
                        'airline' => $airline,
                        'cabin_class' => 'economy',
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

                // Optionally add 1-2 premium/business/first flights per day for variety
                if (rand(1, 3) == 1) { // 33% chance to add a premium flight
                    $airline = $airlines[array_rand($airlines)];
                    $departureTime = $departureTimes[array_rand($departureTimes)];
                    $arrivalTime = $this->addDurationToTime($departureTime, $duration);
                    $price = rand($priceMin * 2, $priceMax * 2);
                    $flights[] = [
                        'origin' => $origin,
                        'destination' => $dest,
                        'departure_date' => $departureDate,
                        'departure_time' => $departureTime,
                        'arrival_time' => $arrivalTime,
                        'airline' => $airline,
                        'cabin_class' => 'premium',
                        'price' => $price,
                        'available_seats' => rand(5, 30),
                        'duration' => $duration,
                        'origin_terminal' => 'T' . rand(1, 2),
                        'destination_terminal' => 'T' . rand(1, 3),
                        'baggage' => 'Checked baggage 25 kg',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        // Insert in chunks to avoid memory issues
        $chunks = array_chunk($flights, 500);
        foreach ($chunks as $chunk) {
            DB::table('flights')->insert($chunk);
        }
    }

    /**
     * Helper to add duration (like "4h 15m") to a time string.
     */
    private function addDurationToTime($time, $duration)
    {
        $parts = explode(':', $time);
        $hours = (int)$parts[0];
        $minutes = (int)$parts[1];

        // Parse duration (e.g., "4h 15m" or "55m")
        if (strpos($duration, 'h') !== false) {
            preg_match('/(\d+)h\s*(\d+)m/', $duration, $matches);
            $addHours = isset($matches[1]) ? (int)$matches[1] : 0;
            $addMinutes = isset($matches[2]) ? (int)$matches[2] : 0;
        } else {
            // only minutes
            preg_match('/(\d+)m/', $duration, $matches);
            $addHours = 0;
            $addMinutes = isset($matches[1]) ? (int)$matches[1] : 0;
        }

        $totalMinutes = $hours * 60 + $minutes + $addHours * 60 + $addMinutes;
        $newHours = floor($totalMinutes / 60) % 24;
        $newMinutes = $totalMinutes % 60;
        return sprintf('%02d:%02d:00', $newHours, $newMinutes);
    }
}