<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Attraction;

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

        // Get attractions grouped by destination (only destinations that have attractions)
        $attractionsByDestination = Destination::with(['attractions' => function($q) {
            $q->where('is_active', true)->take(6); // limit per destination
        }])->has('attractions')->get();

        return view('home', compact('destinations', 'packages', 'testimonials', 'attractionsByDestination'));
    }
}