<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Show all hotels
    public function index(Request $request)
    {
        $query = Hotel::query();

        // Filter by city if provided
        if ($request->filled('city')) {
            $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        
        $hotels = $query->orderBy('stars', 'desc')->simplePaginate(12);

        // Get unique cities for filter dropdown
        $cities = Hotel::select('city')->distinct()->pluck('city');

        return view('hotels.index', compact('hotels', 'cities'));
    }

    // Show single hotel details (optional)
    public function show(Hotel $hotel)
{
    // Decode gallery if stored as JSON
    $gallery = $hotel->gallery ? json_decode($hotel->gallery, true) : [];
    return view('hotels.show', compact('hotel', 'gallery'));
}

public function hotelBooking(){
    return $this->hasMany(HotelBooking::class);
}
}