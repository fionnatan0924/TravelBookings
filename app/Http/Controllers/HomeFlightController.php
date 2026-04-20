<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class HomeFlightController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destination::orderBy('name', 'asc')->get();
        return view('flights.search', compact('destinations'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'required|date',
            'passengers' => 'required|integer|min:1'
        ]);

        $query = Flight::where('from', $request->from)
            ->where('to', $request->to)
            ->where('departure_date', $request->departure_date)
            ->where('available_seats', '>=', $request->passengers);

        if ($request->sort == 'price') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'departure_time') {
            $query->orderBy('departure_time', 'asc');
        }

        $flights = $query->paginate(10);

        return view('flights.results', compact('flights'));
    }
}