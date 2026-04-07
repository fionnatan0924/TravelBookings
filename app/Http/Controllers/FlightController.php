<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        return view('flights.search'); // this view must exist
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'required|date',
            'passengers' => 'required|integer|min:1'
        ]);

        $flights = Flight::where('from', $request->from)
            ->where('to', $request->to)
            ->where('departure_date', $request->departure_date)
            ->where('available_seats', '>=', $request->passengers)
            ->get();

        return view('flights.results', compact('flights'));
    }
}