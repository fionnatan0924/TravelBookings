<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    // Make sure all booking actions require login
    public function __construct() {
       // $this->middleware('auth');
    }

    // Step 1: Store selected flight in session (temporary)
    public function selectFlight(Request $request) {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'trip_type' => 'required|in:oneway,round,multi',
            'flight_type' => 'required|in:outbound,return',
        ]);

        $flight = Flight::findOrFail($request->flight_id);
        $booking = session('booking', []);
        
        if ($request->flight_type == 'outbound') {
            $booking['outbound_flight_id'] = $flight->id;
        } else {
            $booking['return_flight_id'] = $flight->id;
        }
        $booking['trip_type'] = $request->trip_type;
        session(['booking' => $booking]);

        return redirect()->route('booking.luggage');
    }

    // Step 2: Show luggage form
    public function showLuggageForm() {
        $booking = session('booking');
        if (!$booking || !isset($booking['outbound_flight_id'])) {
            return redirect()->route('flights.index')->with('error', 'Select a flight first.');
        }
        $flight = Flight::find($booking['outbound_flight_id']);
        return view('booking.luggage', compact('flight'));
    }

    // Step 3: Process luggage
    public function processLuggage(Request $request) {
        $request->validate(['add_luggage' => 'required|in:yes,no']);
        $booking = session('booking');
        $extraCost = 0;
        if ($request->add_luggage == 'yes') {
            $adults = session('search_params.adults', 1);
            $extraCost = $adults * 50;
        }
        $booking['luggage'] = $request->add_luggage;
        $booking['luggage_cost'] = $extraCost;
        session(['booking' => $booking]);
        return redirect()->route('booking.passengers');
    }

    // Step 4: Show passenger form
    public function showPassengerForm() {
        $booking = session('booking');
        if (!$booking) return redirect()->route('flights.index')->with('error', 'Session expired.');
        $searchParams = session('search_params', []);
        $adults = $searchParams['adults'] ?? 1;
        $children = $searchParams['children'] ?? 0;
        $infants = $searchParams['infants'] ?? 0;
        return view('booking.passengers', compact('adults', 'children', 'infants'));
    }

    // Step 5: Save passengers and CREATE booking in DB
    public function processPassengers(Request $request)
{
    $bookingSession = session('booking');
    if (!$bookingSession) {
        return redirect()->route('flights.index')->with('error', 'Session expired.');
    }

    $adults = $request->input('adults_count', 0);
    $children = $request->input('children_count', 0);
    $infants = $request->input('infants_count', 0);

    // Build validation rules
    $rules = [];
    for ($i = 1; $i <= $adults; $i++) {
        $rules["adult_{$i}.full_name"] = 'required|string|max:255';
        $rules["adult_{$i}.dob"] = 'required|date|before:today';
        $rules["adult_{$i}.nationality"] = 'required|string|max:100';
        $rules["adult_{$i}.passport"] = 'required|string|size:9|regex:/^[A-Z0-9]+$/';
    }
    for ($i = 1; $i <= $children; $i++) {
        $rules["child_{$i}.full_name"] = 'required|string|max:255';
        $rules["child_{$i}.dob"] = 'required|date|before:today';
        $rules["child_{$i}.nationality"] = 'required|string|max:100';
        $rules["child_{$i}.passport"] = 'nullable|string|size:9|regex:/^[A-Z0-9]+$/';
    }
    for ($i = 1; $i <= $infants; $i++) {
        $rules["infant_{$i}.full_name"] = 'required|string|max:255';
        $rules["infant_{$i}.dob"] = 'required|date|before:today';
    }

    $validated = $request->validate($rules);

    // Price calculation
    $outboundFlight = Flight::find($bookingSession['outbound_flight_id']);
    $basePrice = $outboundFlight->price;
    $totalPrice = ($basePrice * $adults) + ($bookingSession['luggage_cost'] ?? 0);
    if (isset($bookingSession['return_flight_id'])) {
        $returnFlight = Flight::find($bookingSession['return_flight_id']);
        $totalPrice += $returnFlight->price * $adults;
    }

    // Create booking
    $booking = Booking::create([
        'user_id' => Auth::id(),
        'outbound_flight_id' => $bookingSession['outbound_flight_id'],
        'return_flight_id' => $bookingSession['return_flight_id'] ?? null,
        'booking_reference' => strtoupper(Str::random(8)),
        'status' => 'confirmed',
        'total_price' => $totalPrice,
        'luggage_option' => $bookingSession['luggage'],
        'luggage_cost' => $bookingSession['luggage_cost'],
        'booking_date' => now(),
    ]);

    // Save passengers – using nested array access
    for ($i = 1; $i <= $adults; $i++) {
        Passenger::create([
            'booking_id' => $booking->id,
            'type' => 'adult',
            'full_name' => $validated["adult_{$i}"]['full_name'],
            'dob' => $validated["adult_{$i}"]['dob'],
            'nationality' => $validated["adult_{$i}"]['nationality'],
            'passport_number' => $validated["adult_{$i}"]['passport'],
        ]);
    }

    for ($i = 1; $i <= $children; $i++) {
        Passenger::create([
            'booking_id' => $booking->id,
            'type' => 'child',
            'full_name' => $validated["child_{$i}"]['full_name'],
            'dob' => $validated["child_{$i}"]['dob'],
            'nationality' => $validated["child_{$i}"]['nationality'],
            'passport_number' => $validated["child_{$i}"]['passport'] ?? null,
        ]);
    }

    for ($i = 1; $i <= $infants; $i++) {
        Passenger::create([
            'booking_id' => $booking->id,
            'type' => 'infant',
            'full_name' => $validated["infant_{$i}"]['full_name'],
            'dob' => $validated["infant_{$i}"]['dob'],
            'nationality' => null,
            'passport_number' => null,
        ]);
    }

    session()->forget('booking');
    return redirect()->route('booking.show', $booking->id)->with('success', 'Booking confirmed!');
}

    // ========== CRUD OPERATIONS ==========
    
    // READ: List all bookings of logged-in user
    public function index() {
        $bookings = Auth::user()->bookings()->with('outboundFlight', 'returnFlight')->latest()->get();
        return view('booking.index', compact('bookings'));
    }

    // READ: Show single booking details
    public function show(Booking $booking) {
        // Authorize: only owner can view
        $this->authorize('view', $booking);
        return view('booking.show', compact('booking'));
    }

    // UPDATE: Cancel booking (status change)
    public function cancel(Booking $booking) {
        $this->authorize('update', $booking);
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('booking.index')->with('success', 'Booking cancelled.');
    }
}