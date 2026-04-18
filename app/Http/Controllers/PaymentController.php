<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ComboBooking;
use App\Models\Passenger;
use App\Models\ComboPassenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ========== FLIGHT PAYMENT ==========
    public function flightPaymentForm()
    {
        $booking = session('pending_flight_booking');
        if (!$booking) {
            return redirect()->route('flights.index')->with('error', 'No booking in progress.');
        }
        $total = $booking['total_price'];
        $type = 'flight';
        $details = $booking;
        return view('payment.form', compact('total', 'type', 'details'));
    }

    public function processFlightPayment(Request $request)
    {
        // Validate payment details
        $cardNumber = str_replace(' ', '', $request->card_number);
        $request->merge(['card_number' => $cardNumber]);
        $request->validate([
            'card_number' => 'required|string|size:16|regex:/^\d{16}$/',
            'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'cvv' => 'required|string|size:3|regex:/^\d{3}$/',
        ]);

        $bookingData = session('pending_flight_booking');
        if (!$bookingData) {
            return redirect()->route('flights.index')->with('error', 'No booking data.');
        }

        // Create flight booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'outbound_flight_id' => $bookingData['outbound_flight_id'],
            'return_flight_id' => $bookingData['return_flight_id'] ?? null,
            'booking_reference' => strtoupper(Str::random(8)),
            'status' => 'confirmed',
            'total_price' => $bookingData['total_price'],
            'luggage_option' => $bookingData['luggage_option'],
            'luggage_cost' => $bookingData['luggage_cost'],
            'booking_date' => now(),
        ]);

        // Save passengers
        foreach ($bookingData['passengers'] as $passenger) {
            Passenger::create([
                'booking_id' => $booking->id,
                'type' => $passenger['type'],
                'full_name' => $passenger['full_name'],
                'dob' => $passenger['dob'],
                'nationality' => $passenger['nationality'],
                'passport_number' => $passenger['passport_number'],
            ]);
        }

        session()->forget('pending_flight_booking');
        return redirect()->route('booking.show', $booking->id)->with('success', 'Payment successful! Booking confirmed.');
    }

    // ========== HOTEL PAYMENT ==========
    public function hotelPaymentForm()
    {
        $booking = session('pending_hotel_booking');
        if (!$booking) {
            return redirect()->route('hotels.index')->with('error', 'No booking in progress.');
        }
        $total = $booking['total_price'];
        $type = 'hotel';
        $details = $booking;
        return view('payment.form', compact('total', 'type', 'details'));
    }

    public function processHotelPayment(Request $request)
    {
        $cardNumber = str_replace(' ', '', $request->card_number);
        $request->merge(['card_number' => $cardNumber]);
        $request->validate([
            'card_number' => 'required|string|size:16|regex:/^\d{16}$/',
            'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'cvv' => 'required|string|size:3|regex:/^\d{3}$/',
        ]);

        $bookingData = session('pending_hotel_booking');
        if (!$bookingData) {
            return redirect()->route('hotels.index')->with('error', 'No booking data.');
        }

        $hotelBooking = \App\Models\HotelBooking::create([
            'user_id' => Auth::id(),
            'hotel_id' => $bookingData['hotel_id'],
            'check_in' => $bookingData['check_in'],
            'check_out' => $bookingData['check_out'],
            'guests' => $bookingData['guests'],
            'total_price' => $bookingData['total_price'],
            'booking_reference' => strtoupper(Str::random(10)),
            'status' => 'confirmed',
        ]);

        session()->forget('pending_hotel_booking');
        return redirect()->route('hotel.receipt', $hotelBooking->id)->with('success', 'Payment successful! Booking confirmed.');
    }

    // ========== COMBO PAYMENT ==========
    public function comboPaymentForm()
    {
        $booking = session('pending_combo_booking');
        if (!$booking) {
            return redirect()->route('combo.index')->with('error', 'No booking in progress.');
        }
        $total = $booking['total_price'];
        $type = 'combo';
        $details = $booking;
        return view('payment.form', compact('total', 'type', 'details'));
    }

    public function processComboPayment(Request $request)
    {
        $cardNumber = str_replace(' ', '', $request->card_number);
        $request->merge(['card_number' => $cardNumber]);
        $request->validate([
            'card_number' => 'required|string|size:16|regex:/^\d{16}$/',
            'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'cvv' => 'required|string|size:3|regex:/^\d{3}$/',
        ]);

        $bookingData = session('pending_combo_booking');
        if (!$bookingData) {
            return redirect()->route('combo.index')->with('error', 'No booking data.');
        }

        $comboBooking = ComboBooking::create([
            'user_id' => Auth::id(),
            'flight_id' => $bookingData['flight_id'],
            'hotel_id' => $bookingData['hotel_id'],
            'check_in_date' => $bookingData['check_in_date'],
            'check_out_date' => $bookingData['check_out_date'],
            'guests' => $bookingData['guests'],
            'total_price' => $bookingData['total_price'],
            'booking_reference' => strtoupper(Str::random(10)),
            'status' => 'confirmed',
        ]);

        // Save combo passengers
        foreach ($bookingData['passengers'] as $passenger) {
            ComboPassenger::create([
                'combo_booking_id' => $comboBooking->id,
                'type' => $passenger['type'],
                'full_name' => $passenger['full_name'],
                'dob' => $passenger['dob'],
                'nationality' => $passenger['nationality'],
                'passport_number' => $passenger['passport_number'],
            ]);
        }

        session()->forget('pending_combo_booking');
        return redirect()->route('combo.show', $comboBooking->id)->with('success', 'Payment successful! Combo confirmed.');
    }
}