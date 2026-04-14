<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Carbon\Carbon;

class FlightController extends Controller
{
    // Show flight search form
    public function index()
{
    // List of available destinations (city name => airport code)
    $destinations = [
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
        'Hokkaido'     => 'CTS',
        'Chiang Mai'   => 'CNX',
        'Sabah'        => 'BKI',
    ];

    return view('flight', compact('destinations'));
}
    

    // Handle flight search (oneway, round, multi-city)
    public function search(Request $request)
    {
        // ---- Normalise input ----
        if (!$request->has('trip_type')) {
            $request->merge(['trip_type' => 'oneway']);
        }
        if (!$request->has('class')) {
            $request->merge(['class' => 'economy']);
        }
        if (!$request->has('adults') && $request->has('passengers')) {
            $request->merge([
                'adults'   => $request->passengers,
                'children' => 0,
                'infants'  => 0,
            ]);
        }

        // ---- Validation ----
        $rules = [
            'trip_type' => 'required|in:oneway,round,multi',
            'adults'    => 'required|integer|min:1',
            'children'  => 'nullable|integer|min:0',
            'infants'   => 'nullable|integer|min:0',
            'class'     => 'required|string|in:economy,premium,business,first',
        ];

        if ($request->trip_type !== 'multi') {
            $rules['from']           = 'required|string';
            $rules['to']             = 'required|string|different:from';
            $rules['departure_date'] = 'required|date|after_or_equal:today';
            if ($request->trip_type === 'round') {
                $rules['return_date'] = 'required|date|after_or_equal:departure_date';
            }
        } else {
            $rules['multi_segments']            = 'required|array|min:1';
            $rules['multi_segments.*.from']     = 'required|string';
            $rules['multi_segments.*.to']       = 'required|string|different:multi_segments.*.from';
            $rules['multi_segments.*.date']     = 'required|date|after_or_equal:today';
        }

        $validated = $request->validate($rules);

        // ---- STORE SEARCH IN SESSION ----
        if ($request->trip_type !== 'multi') {
            $searchHistory = session()->get('flight_searches', []);
            $currentSearch = [
                'from'          => $request->from,
                'to'            => $request->to,
                'departure_date'=> $request->departure_date,
                'class'         => $request->class,
                'adults'        => $request->adults,
                'searched_at'   => now()->toDateTimeString(),
            ];
            array_unshift($searchHistory, $currentSearch);
            $searchHistory = array_slice($searchHistory, 0, 5);
            session()->put('flight_searches', $searchHistory);
        }

        $tripType = $request->trip_type;

        // ---- Robust mapping from city name to airport code ----
        // Expanded mapping: includes direct codes, full names, common misspellings
        $cityToCode = [
            // Malaysia
            'kuala lumpur' => 'KUL',
            'kualalumpur'  => 'KUL',
            'kul'          => 'KUL',
            'kl'           => 'KUL',
            'penang'       => 'PEN',
            'pen'          => 'PEN',
            'johor bahru'  => 'JHB',
            'jhb'          => 'JHB',
            'johor'        => 'JHB',
            'langkawi'     => 'LGK',
            'lgk'          => 'LGK',
            // International
            'guangzhou'    => 'CAN',
            'can'          => 'CAN',
            'singapore'    => 'SIN',
            'sin'          => 'SIN',
            'bangkok'      => 'BKK',
            'bkk'          => 'BKK',
            'hong kong'    => 'HKG',
            'hkg'          => 'HKG',
            'tokyo'        => 'NRT',
            'nrt'          => 'NRT',
            'hanoi'        => 'HAN',
            'han'          => 'HAN',
        ];

        // Function to get airport code, with fallback to original if not found
        $getCode = function($input) use ($cityToCode) {
            $lower = strtolower(trim($input));
            return $cityToCode[$lower] ?? $input;
        };

        // ---- Build search params for the view ----
        $searchParams = [
            'adults'   => (int) $request->adults,
            'children' => (int) ($request->children ?? 0),
            'infants'  => (int) ($request->infants ?? 0),
            'class'    => $request->class,
        ];

        session(['search_params' => $searchParams]);

        // ---- Multi-city handling ----
        if ($tripType === 'multi') {
            $searchParams['segments'] = $request->multi_segments;
            $results = [];
            foreach ($request->multi_segments as $segment) {
                $fromCode = $getCode($segment['from']);
                $toCode   = $getCode($segment['to']);
                $flights = Flight::where('origin', $fromCode)
                    ->where('destination', $toCode)
                    ->whereDate('departure_date', $segment['date'])
                    ->where('cabin_class', $request->class)
                    ->get();
                $results[] = [
                    'segment' => $segment,
                    'flights' => $flights
                ];
            }
            return view('flights.results', compact('tripType', 'searchParams', 'results'));
        }

        // ---- One-way or Return ----
        $searchParams['origin']         = $request->from;
        $searchParams['destination']    = $request->to;
        $searchParams['departure_date'] = $request->departure_date;

        if ($tripType === 'round') {
            $searchParams['return_date'] = $request->return_date;
        }

        // Convert to codes for DB lookup
        $fromCode = $getCode($request->from);
        $toCode   = $getCode($request->to);

        // Build query
        $query = Flight::where('origin', $fromCode)
            ->where('destination', $toCode)
            ->whereDate('departure_date', $request->departure_date)
            ->where('cabin_class', $request->class);

        // Optional sorting
        if ($request->has('sort') && in_array($request->sort, ['price', 'departure_time'])) {
            $query->orderBy($request->sort);
        }

        $outboundFlights = $query->get();

        // If no flights found, try a fallback: ignore class or date? 
        // But we'll just show a friendly message (already handled in view)

        $returnFlights = null;
        if ($tripType === 'round') {
            $returnQuery = Flight::where('origin', $toCode)
                ->where('destination', $fromCode)
                ->whereDate('departure_date', $request->return_date)
                ->where('cabin_class', $request->class);
            if ($request->has('sort')) {
                $returnQuery->orderBy($request->sort);
            }
            $returnFlights = $returnQuery->get();
        }

        $totalPassengers = $searchParams['adults'] + $searchParams['children'] + $searchParams['infants'];

        return view('flights.results', compact('tripType', 'searchParams', 'outboundFlights', 'returnFlights', 'totalPassengers'));
    }
}