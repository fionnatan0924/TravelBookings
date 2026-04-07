<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    //show search form
    public function index()
    {
        return view('flights.search');
    }

    //handle search 
    public function search (Request $request)
    {
         // Validation
         $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'required|date',
            'passengers' => 'required|integer|min:1'
        ]);

        session([
            'last_search' => $request->only(['from', 'to'])
        ]);

         // Query
         $flights = Flight::where('from', $request->from)
         ->where('to', $request->to)
         ->where('departure_date', $request->departure_date)
         ->where('available_seats', '>=', $request->passengers)
         ->orderBy('price', 'asc')
         ->get();

     return view('flights.results', compact('flights'));
 }
    
    }
