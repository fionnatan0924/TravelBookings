<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Destination;
use App\Models\AttractionBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AttractionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'bookForm', 'confirmBooking', 'proceedToPayment',
            'paymentForm', 'processPayment', 'receipt'
        ]);
    }

    /**
     * Display a listing of attractions with search/filters.
     */
    public function index(Request $request)
    {
        $query = Attraction::with('destination')->where('is_active', true);

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

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
    public function show(Attraction $attraction)
    {
        $attraction->load('destination');
        return view('attractions.show', compact('attraction'));
    }

    /**
     * Display the attraction booking page (ticket quantity form).
     */
    public function book(Attraction $attraction)
    {
        return view('attractions.book', compact('attraction'));
    }

    /**
     * Process the booking form, store in session, redirect to confirmation.
     */
    public function bookForm(Request $request)
{
    $validated = $request->validate([
        'attraction_id' => 'required|exists:attractions,id',
        'number_of_people' => 'required|integer|min:1|max:50',
    ]);

    $attraction = Attraction::findOrFail($validated['attraction_id']);
    $totalPrice = $attraction->price * $validated['number_of_people'];

    // Store directly as pending booking (ready for payment)
    session(['pending_attraction_booking' => [
        'attraction_id' => $attraction->id,
        'number_of_people' => $validated['number_of_people'],
        'total_price' => $totalPrice,
        'attraction_name' => $attraction->name,
        'destination' => $attraction->destination->name,
    ]]);

    // Redirect straight to payment form
    return redirect()->route('payment.attraction.form');
}

    /**
     * Show confirmation page before payment.
     */
    public function confirmBooking()
    {
        $booking = session('attraction_booking');
        if (!$booking) {
            return redirect()->route('attractions.index')->with('error', 'No booking in progress.');
        }
        $attraction = Attraction::findOrFail($booking['attraction_id']);
        return view('attractions.booking_confirm', compact('attraction', 'booking'));
    }

    /**
     * Move booking data to pending and redirect to payment page.
     */
    public function proceedToPayment()
    {
        $booking = session('attraction_booking');
        if (!$booking) {
            return redirect()->route('attractions.index')->with('error', 'No booking in progress.');
        }
        session(['pending_attraction_booking' => $booking]);
        session()->forget('attraction_booking');
        return redirect()->route('payment.attraction.form');
    }

    /**
     * Show the payment form (reuses payment.form view).
     */
    public function paymentForm()
    {
        $booking = session('pending_attraction_booking');
        if (!$booking) {
            return redirect()->route('attractions.index')->with('error', 'No booking data found.');
        }

        $total = $booking['total_price'];
        $type = 'attraction';
        return view('payment.form', compact('total', 'type'));
    }

    /**
     * Process payment and create attraction booking record.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
            'expiry' => 'required|string',
            'cvv' => 'required|string',
        ]);

        $bookingData = session('pending_attraction_booking');
        if (!$bookingData) {
            return redirect()->route('attractions.index')->with('error', 'No booking data.');
        }

        $attractionBooking = AttractionBooking::create([
            'user_id' => Auth::id(),
            'attraction_id' => $bookingData['attraction_id'],
            'number_of_people' => $bookingData['number_of_people'],
            'total_price' => $bookingData['total_price'],
            'booking_reference' => strtoupper(Str::random(10)),
            'status' => 'confirmed',
            'booking_date' => now(),
        ]);

        session()->forget('pending_attraction_booking');
        return redirect()->route('attraction.receipt', $attractionBooking->id)->with('success', 'Payment successful! Attraction booked.');
    }

    /**
     * Show receipt after payment.
     */
    public function receipt($id)
{
    $booking = AttractionBooking::with('attraction')->findOrFail($id);
    if ($booking->user_id !== Auth::id()) {
        abort(403);
    }
    return view('attractions.receipt', compact('booking'));
}

    /**
     * Show the form for editing an attraction (Admin only).
     */
    public function edit(Attraction $attraction)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $destinations = Destination::all();
        return view('admin.attractions.edit', compact('attraction', 'destinations'));
    }

    /**
     * Update the specified attraction (Admin only).
     */
    public function update(Request $request, Attraction $attraction)
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

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction updated successfully.');
    }

    /**
     * Remove the specified attraction (Admin only).
     */
    public function destroy(Attraction $attraction)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
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