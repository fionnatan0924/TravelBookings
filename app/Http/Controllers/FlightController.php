<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    // Show search form
    public function index()
    {
        return view('flights.search');
    }

    // Handle search
    public function search(Request $request)
    {
        //Validation
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'required|date',
            'passengers' => 'required|integer|min:1',
            'sort' => 'nullable|string'
        ]);

        //Save session (for assignment)
        session([
            'last_search' => $request->only(['from', 'to'])
        ]);

        // Sorting
        $sort = $request->sort ?? 'price';

        // Query (advanced)
        $flights = Flight::where('from', 'LIKE', "%{$request->from}%")
            ->where('to', 'LIKE', "%{$request->to}%")
            ->where('departure_date', $request->departure_date)
            ->where('available_seats', '>=', $request->passengers)
            ->orderBy($sort, 'asc')
            ->paginate(5)
            ->appends($request->all()); // keep form data in pagination

        return view('flights.results', compact('flights'));
    }
}