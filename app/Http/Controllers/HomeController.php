<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Attraction;
use App\Http\Controllers\HotelController;

class HomeController extends Controller
{
    public function index()
    {
        session(['last_visited' => now()]);

        $destinations = Destination::withCount('packages')
            ->orderBy('name', 'asc')
            ->get();

        $packages = Package::where('is_active', true)
            ->orderByDesc('is_featured')
            ->take(3)
            ->get();

        $testimonials = Testimonial::with('user')
            ->latest()
            ->take(3)
            ->get();

        // Load all active attractions and group them by destination manually
$allAttractions = Attraction::where('is_active', true)->get();
$attractionsByDestination = Destination::orderBy('name', 'asc')->get();
foreach ($attractionsByDestination as $dest) {
    $dest->attractions = $allAttractions->where('destination_id', $dest->id)->take(6);
}

        return view('home', compact('destinations', 'packages', 'testimonials', 'attractionsByDestination'));
    }
}