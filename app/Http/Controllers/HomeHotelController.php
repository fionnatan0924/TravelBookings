<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeHotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::where('is_active', true);

        // Filter by destination
        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $hotels = $query->paginate(12)->withQueryString();
        $destinations = Destination::all();

        return view('hotels.index', compact('hotels', 'destinations'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }
}
