<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Carbon\Carbon;

class FlightController extends Controller
{
    // Show flight search form (your Travelio form)
    public function index()
    {
        return view('flight'); // flight.blade.php
    }

    // Handle flight search (supports oneway, round, multi-city)
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

        $tripType = $request->trip_type;

        // ---- Map full city names to airport codes (if your DB uses codes) ----
        $cityToCode = [
            'kuala lumpur' => 'KUL',
            'penang'       => 'PEN',
            'johor bahru'  => 'JHB',
            'langkawi'     => 'LGK',
            'guangzhou'    => 'CAN',
            'kualalumpur'  => 'KUL',   // no space variant
        ];

        // ---- Build $searchParams for the view (keep original names for display) ----
        $searchParams = [
            'adults'   => (int) $request->adults,
            'children' => (int) ($request->children ?? 0),
            'infants'  => (int) ($request->infants ?? 0),
            'class'    => $request->class,
        ];

        // ---- Perform search and prepare data for the view ----
        if ($tripType === 'multi') {
            $searchParams['segments'] = $request->multi_segments;
            $results = [];
            foreach ($request->multi_segments as $segment) {
                $fromCode = $cityToCode[strtolower($segment['from'])] ?? $segment['from'];
                $toCode   = $cityToCode[strtolower($segment['to'])] ?? $segment['to'];
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

        // Convert to codes for database lookup
        $fromCode = $cityToCode[strtolower($request->from)] ?? $request->from;
        $toCode   = $cityToCode[strtolower($request->to)] ?? $request->to;

        $outboundFlights = Flight::where('origin', $fromCode)
            ->where('destination', $toCode)
            ->whereDate('departure_date', $request->departure_date)
            ->where('cabin_class', $request->class)
            ->get();

        if ($request->has('sort') && in_array($request->sort, ['price', 'departure_time'])) {
            $outboundFlights = $outboundFlights->sortBy($request->sort);
        }

        $returnFlights = null;
        if ($tripType === 'round') {
            $returnFlights = Flight::where('origin', $toCode)
                ->where('destination', $fromCode)
                ->whereDate('departure_date', $request->return_date)
                ->where('cabin_class', $request->class)
                ->get();

            if ($request->has('sort')) {
                $returnFlights = $returnFlights->sortBy($request->sort);
            }
        }

        $totalPassengers = $searchParams['adults'] + $searchParams['children'] + $searchParams['infants'];

        return view('flights.results', compact('tripType', 'searchParams', 'outboundFlights', 'returnFlights', 'totalPassengers'));
    }
}