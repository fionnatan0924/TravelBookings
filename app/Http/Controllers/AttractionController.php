<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttractionController extends Controller
{
    /**
     * Display a listing of attractions with search/filters.
     */
    public function index(Request $request)
    {
        $query = Attraction::with('destination')->where('is_active', true);

        // Filter by destination
        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        // Filter by min price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by max price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->latest();
        }

        $attractions = $query->paginate(12)->withQueryString();
        $destinations = Destination::all();

        // Store search filters in session (assignment requirement #7)
        session(['last_attraction_search' => $request->all()]);

        return view('attractions.index', compact('attractions', 'destinations'));
    }

    /**
     * Show the form for creating a new attraction (Admin only).
     */
    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $destinations = Destination::all();
        return view('admin.attractions.create', compact('destinations'));
    }

    /**
     * Store a newly created attraction in database (Admin only).
     */
    public function store(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'nullable|numeric|min:0|max:10',
            'reviews' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'discount_text' => 'nullable|string|max:50',
            'booking_text' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
            'schedule_info' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:1',
            'max_tickets_per_booking' => 'nullable|integer|min:1|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        Attraction::create($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction created successfully.');
    }

    /**
     * Display the specified attraction (detail page).
     */
    public function show($id)
    {
        $attraction = Attraction::with('destination')->findOrFail($id);
        // Increment view count or store in session (optional)
        return view('attractions.show', compact('attraction'));
    }

    /**
     * Show the form for editing an attraction (Admin only).
     */
    public function edit($id)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $attraction = Attraction::findOrFail($id);
        $destinations = Destination::all();
        return view('admin.attractions.edit', compact('attraction', 'destinations'));
    }

    /**
     * Update the specified attraction (Admin only).
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }

        $attraction = Attraction::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'nullable|numeric|min:0|max:10',
            'reviews' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'discount_text' => 'nullable|string|max:50',
            'booking_text' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
            'schedule_info' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:1',
            'max_tickets_per_booking' => 'nullable|integer|min:1|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction updated successfully.');
    }

    /**
     * Remove the specified attraction (Admin only).
     */
    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction deleted successfully.');
    }

    /**
     * Admin listing of all attractions (with pagination).
     */
    public function adminIndex(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $attractions = Attraction::with('destination')->paginate(15);
        return view('admin.attractions.index', compact('attractions'));
    }
}