<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::withCount('packages')->get();
        return view('destinations.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::with('packages')->findOrFail($id);
        return view('destinations.show', compact('destination'));
    }
}