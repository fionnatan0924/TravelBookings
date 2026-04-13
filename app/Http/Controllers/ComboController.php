<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\ComboBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComboController extends Controller
{
    public function __construct() {
       $this->middleware('auth'); // require login for combo booking
    }

    // Show combo search form
    public function index() {
        return view('combo.search');
    }

    // Search for flights + hotels
    public function search(Request $request) {
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string|different:origin',
            'departure_date' => 'required|date|after_or_equal:today',
            'check_in' => 'required|date|after_or_equal:departure_date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        // Find flights
        $flights = Flight::where('origin', $validated['origin'])
            ->where('destination', $validated['destination'])
            ->whereDate('departure_date', $validated['departure_date'])
            ->get();

        // Find hotels in destination city
        $hotels = Hotel::where('city', 'LIKE', '%'.$validated['destination'].'%')->get();

        if ($flights->isEmpty() || $hotels->isEmpty()) {
            return back()->with('error', 'No combos available for your criteria.');
        }

        // Store search params in session for booking step
        session(['combo_search' => $validated]);

        return view('combo.results', compact('flights', 'hotels', 'validated'));
    }

    // Book a specific combo
    public function book(Request $request) {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $search = session('combo_search');
        if (!$search) {
            return redirect()->route('combo.index')->with('error', 'Please search again.');
        }

        $flight = Flight::findOrFail($validated['flight_id']);
        $hotel = Hotel::findOrFail($validated['hotel_id']);

        // Calculate total price: flight price * guests + hotel nights * price_per_night
        $nights = (new \DateTime($search['check_in']))->diff(new \DateTime($search['check_out']))->days;
        $totalFlight = $flight->price * $search['guests'];
        $totalHotel = $hotel->price_per_night * $nights;
        $totalPrice = $totalFlight + $totalHotel;

        // Create combo booking
        $comboBooking = ComboBooking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'hotel_id' => $hotel->id,
            'check_in_date' => $search['check_in'],
            'check_out_date' => $search['check_out'],
            'guests' => $search['guests'],
            'total_price' => $totalPrice,
            'booking_reference' => strtoupper(Str::random(10)),
            'status' => 'confirmed',
        ]);

        session()->forget('combo_search');
        return redirect()->route('combo.show', $comboBooking->id)->with('success', 'Combo booked!');
    }

    // List user's combo bookings
    public function myBookings() {
        $bookings = Auth::user()->comboBookings()->with(['flight', 'hotel'])->latest()->get();
        return view('combo.my_bookings', compact('bookings'));
    }

    // Show single combo booking
    public function show(ComboBooking $comboBooking) {
        $this->authorize('view', $comboBooking);
        return view('combo.show', compact('comboBooking'));
    }

    // Cancel combo booking
    public function cancel(ComboBooking $comboBooking) {
        $this->authorize('update', $comboBooking);
        $comboBooking->update(['status' => 'cancelled']);
        return redirect()->route('combo.my-bookings')->with('success', 'Combo cancelled.');
    }
}