<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    // Make sure all booking actions require login
    public function __construct() {
        // $this->middleware('auth'); // Uncomment for final submission
    }

    // Step 1: Store selected flight in session (temporary)
    public function selectFlight(Request $request)
{
    $request->validate([
        'trip_type' => 'required|in:oneway,round,multi',
    ]);

    $booking = session('booking', []);

    if ($request->trip_type == 'round') {
        // Round trip: both flights come from the form
        $request->validate([
            'outbound_flight_id' => 'required|exists:flights,id',
            'return_flight_id'   => 'required|exists:flights,id',
        ]);
        $booking['outbound_flight_id'] = $request->outbound_flight_id;
        $booking['return_flight_id']   = $request->return_flight_id;
    } else {
        // One-way or multi-city: single flight selection
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'flight_type' => 'required|in:outbound,return',
        ]);
        $flight = Flight::findOrFail($request->flight_id);
        if ($request->flight_type == 'outbound') {
            $booking['outbound_flight_id'] = $flight->id;
        } else {
            $booking['return_flight_id'] = $flight->id;
        }
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

    // Step 5: Save passengers and redirect to payment (store pending in session)
    public function processPassengers(Request $request)
    {
        $bookingSession = session('booking');
        if (!$bookingSession) {
            return redirect()->route('flights.index')->with('error', 'Session expired.');
        }
    
        $adults = $request->input('adults_count', 0);
        $children = $request->input('children_count', 0);
        $infants = $request->input('infants_count', 0);
    
        $rules = [];
        for ($i = 1; $i <= $adults; $i++) {
            $rules["adult_{$i}.full_name"] = 'required|string|max:255';
            $rules["adult_{$i}.dob"] = [
                'required',
                'date_format:Y-m-d',
                'before:today',
                function ($attribute, $value, $fail) {
                    $year = (int) substr($value, 0, 4);
                    if ($year < 1900 || $year > date('Y')) {
                        $fail('The year must be between 1900 and ' . date('Y') . '.');
                    }
                },
            ];
            $rules["adult_{$i}.nationality"] = 'required|string|max:100';
            $rules["adult_{$i}.passport"] = 'required|string|size:9|regex:/^[A-Z0-9]+$/';
        }
        for ($i = 1; $i <= $children; $i++) {
            $rules["child_{$i}.full_name"] = 'required|string|max:255';
            $rules["child_{$i}.dob"] = [
                'required',
                'date_format:Y-m-d',
                'before:today',
                function ($attribute, $value, $fail) {
                    $year = (int) substr($value, 0, 4);
                    if ($year < 1900 || $year > date('Y')) {
                        $fail('The year must be between 1900 and ' . date('Y') . '.');
                    }
                },
            ];
            $rules["child_{$i}.nationality"] = 'required|string|max:100';
            $rules["child_{$i}.passport"] = 'nullable|string|size:9|regex:/^[A-Z0-9]+$/';
        }
        for ($i = 1; $i <= $infants; $i++) {
            $rules["infant_{$i}.full_name"] = 'required|string|max:255';
            $rules["infant_{$i}.dob"] = [
                'required',
                'date_format:Y-m-d',
                'before:today',
                function ($attribute, $value, $fail) {
                    $year = (int) substr($value, 0, 4);
                    if ($year < 1900 || $year > date('Y')) {
                        $fail('The year must be between 1900 and ' . date('Y') . '.');
                    }
                },
            ];
        }
        $validated = $request->validate($rules);
    
        // Calculate total price
        $outboundFlight = Flight::find($bookingSession['outbound_flight_id']);
        $basePrice = $outboundFlight->price;
        $totalPrice = ($basePrice * $adults) + ($bookingSession['luggage_cost'] ?? 0);
        if (isset($bookingSession['return_flight_id'])) {
            $returnFlight = Flight::find($bookingSession['return_flight_id']);
            $totalPrice += $returnFlight->price * $adults;
        }
    
        // Collect passenger data
        $passengers = [];
        for ($i = 1; $i <= $adults; $i++) {
            $passengers[] = [
                'type' => 'adult',
                'full_name' => $validated["adult_{$i}"]['full_name'],
                'dob' => $validated["adult_{$i}"]['dob'],
                'nationality' => $validated["adult_{$i}"]['nationality'],
                'passport_number' => $validated["adult_{$i}"]['passport'],
            ];
        }
        for ($i = 1; $i <= $children; $i++) {
            $passengers[] = [
                'type' => 'child',
                'full_name' => $validated["child_{$i}"]['full_name'],
                'dob' => $validated["child_{$i}"]['dob'],
                'nationality' => $validated["child_{$i}"]['nationality'],
                'passport_number' => $validated["child_{$i}"]['passport'] ?? null,
            ];
        }
        for ($i = 1; $i <= $infants; $i++) {
            $passengers[] = [
                'type' => 'infant',
                'full_name' => $validated["infant_{$i}"]['full_name'],
                'dob' => $validated["infant_{$i}"]['dob'],
                'nationality' => null,
                'passport_number' => null,
            ];
        }
    
        // Store pending flight booking in session
        session(['pending_flight_booking' => [
            'outbound_flight_id' => $bookingSession['outbound_flight_id'],
            'return_flight_id' => $bookingSession['return_flight_id'] ?? null,
            'total_price' => $totalPrice,
            'luggage_option' => $bookingSession['luggage'],
            'luggage_cost' => $bookingSession['luggage_cost'],
            'passengers' => $passengers,
        ]]);
    
        session()->forget('booking');
        return redirect()->route('payment.flight.form');
    }

    // ========== CRUD OPERATIONS ==========
    
    // READ: List all bookings of logged-in user (deprecated – use unified 'my-bookings' instead)
    public function index() {
        $bookings = Auth::user()->bookings()->with('outboundFlight', 'returnFlight')->latest()->get();
        return view('booking.index', compact('bookings'));
    }

    // READ: Show single booking details
    public function show(Booking $booking) {
        $this->authorize('view', $booking);
        return view('booking.show', compact('booking'));
    }

    // UPDATE: Cancel booking (status change)
    public function cancel(Booking $booking) {
        $this->authorize('update', $booking);
        $booking->update(['status' => 'cancelled']);
        // Redirect to unified "My Bookings" page
        return redirect()->route('my-bookings')->with('success', 'Booking cancelled.');
    }
}