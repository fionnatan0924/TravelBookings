<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\ComboBooking;
use App\Models\ComboPassenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComboController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Show combo search form with city names in dropdown
    public function index()
    {
        $airports = Flight::select('origin')->distinct()->pluck('origin')->toArray();
        sort($airports);

        // Map airport code to city name
        $codeToCity = [
            'KUL' => 'Kuala Lumpur',
            'PEN' => 'Penang',
            'LGK' => 'Langkawi',
            'JHB' => 'Johor Bahru',
            'BKI' => 'Sabah',
            'SIN' => 'Singapore',
            'BKK' => 'Bangkok',
            'CNX' => 'Chiang Mai',
            'DPS' => 'Bali',
            'NRT' => 'Tokyo',
            'CTS' => 'Hokkaido',
            'CDG' => 'Paris',
            'HKG' => 'Hong Kong',
            'MLE' => 'Maldives',
            'CAN' => 'Guangzhou',
            'PVG' => 'Shanghai',
            'CKG' => 'Chongqing',
            'HAN' => 'Hanoi',
            'ICN' => 'Seoul',
            'KEF' => 'Reykjavik',
        ];

        $airportOptions = [];
        foreach ($airports as $code) {
            $airportOptions[$code] = $codeToCity[$code] ?? $code;
        }

        return view('combo.search', compact('airportOptions'));
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

        // Find flights (airport codes directly)
        $flights = Flight::where('origin', $validated['origin'])
            ->where('destination', $validated['destination'])
            ->whereDate('departure_date', $validated['departure_date'])
            ->get();

        // Map destination airport code to city name for hotel search
        $codeToCity = [
            'KUL' => 'Kuala Lumpur',
            'PEN' => 'Penang',
            'LGK' => 'Langkawi',
            'JHB' => 'Johor Bahru',
            'BKI' => 'Sabah',
            'SIN' => 'Singapore',
            'BKK' => 'Bangkok',
            'CNX' => 'Chiang Mai',
            'DPS' => 'Bali',
            'NRT' => 'Tokyo',
            'CTS' => 'Hokkaido',
            'CDG' => 'Paris',
            'HKG' => 'Hong Kong',
            'MLE' => 'Maldives',
            'CAN' => 'Guangzhou',
            'PVG' => 'Shanghai',
            'CKG' => 'Chongqing',
            'HAN' => 'Hanoi',
            'ICN' => 'Seoul',
            'KEF' => 'Reykjavik',
        ];

        $destinationCity = $codeToCity[$validated['destination']] ?? $validated['destination'];
        $hotels = Hotel::where('city', 'LIKE', '%'.$destinationCity.'%')->get();

        if ($flights->isEmpty() || $hotels->isEmpty()) {
            return back()->with('error', 'No combos available for your criteria.');
        }

        session(['combo_search' => $validated]);
        return view('combo.results', compact('flights', 'hotels', 'validated'));
    }

    // Book a specific combo (after user selects flight & hotel on results page)
    public function book(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $search = session('combo_search');
        if (!$search) {
            return redirect()->route('combo.index')->with('error', 'Please search again.');
        }

        session(['combo_selection' => [
            'flight_id' => $validated['flight_id'],
            'hotel_id'  => $validated['hotel_id'],
            'search'    => $search,
        ]]);

        return redirect()->route('combo.passengers');
    }

    // Show passenger information form
    public function showPassengerForm()
    {
        $selection = session('combo_selection');
        if (!$selection) {
            return redirect()->route('combo.index')->with('error', 'Please select a combo first.');
        }
        $adults = $selection['search']['guests'];
        $children = 0;
        $infants = 0;
        return view('combo.passengers', compact('adults', 'children', 'infants'));
    }

    // Process passenger details and create combo booking
    public function processPassengers(Request $request)
{
    $selection = session('combo_selection');
    if (!$selection) {
        return redirect()->route('combo.index')->with('error', 'Session expired. Please search again.');
    }

    $adults = $selection['search']['guests'];
    $rules = [];
    for ($i = 1; $i <= $adults; $i++) {
        $rules["adult_{$i}.full_name"] = 'required|string|max:255';
        $rules["adult_{$i}.dob"] = 'required|date|before:today';
        $rules["adult_{$i}.nationality"] = 'required|string|max:100';
        $rules["adult_{$i}.passport"] = 'required|string|size:9|regex:/^[A-Z0-9]+$/';
    }
    $validated = $request->validate($rules);

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

    // Store pending combo booking in session
    session(['pending_combo_booking' => [
        'flight_id' => $selection['flight_id'],
        'hotel_id'  => $selection['hotel_id'],
        'check_in_date'  => $selection['search']['check_in'],
        'check_out_date' => $selection['search']['check_out'],
        'guests'    => $adults,
        'passengers'=> $passengers,
        'total_price'=> $selection['search']['guests'] * Flight::find($selection['flight_id'])->price
                      + Hotel::find($selection['hotel_id'])->price_per_night
                      * (new \DateTime($selection['search']['check_in']))->diff(new \DateTime($selection['search']['check_out']))->days,
    ]]);

    session()->forget('combo_selection');
    session()->forget('combo_search');

    return redirect()->route('payment.combo.form');
}

    // List user's combo bookings
    public function myBookings() {
        $bookings = Auth::user()->comboBookings()->with(['flight', 'hotel'])->latest()->get();
        return view('my_bookings', compact('bookings'));
    }

    // Show single combo booking
    public function show(ComboBooking $comboBooking) {
        $this->authorize('view', $comboBooking);
        $comboBooking->load('passengers');
        return view('combo.show', compact('comboBooking'));
    }

    // Cancel combo booking
    public function cancel(ComboBooking $comboBooking) {
        $this->authorize('update', $comboBooking);
        $comboBooking->update(['status' => 'cancelled']);
        return redirect()->route('combo.my-bookings')->with('success', 'Combo cancelled.');
    }
}