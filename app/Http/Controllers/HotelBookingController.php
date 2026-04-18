<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HotelBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Step 1: Show booking form (from hotel detail page)
    public function bookForm(Request $request, Hotel $hotel)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        // Calculate nights and total price
        $checkIn = \Carbon\Carbon::parse($request->check_in);
        $checkOut = \Carbon\Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $hotel->price_per_night * $nights * $request->guests;

        // Store temporary data in session
        session(['hotel_booking' => [
            'hotel_id' => $hotel->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'nights' => $nights,
            'total_price' => $totalPrice,
        ]]);

        return redirect()->route('hotel.booking.confirm');
    }

    // Step 2: Show confirmation page
    public function confirmBooking()
{
    $booking = session('hotel_booking');
    if (!$booking) {
        return redirect()->route('hotels.index')->with('error', 'No booking in progress.');
    }
    $hotel = Hotel::find($booking['hotel_id']);
    return view('hotels.booking_confirm', compact('hotel', 'booking'));
}

    // Step 3: Proceed to payment (store pending in session)
    public function proceedToPayment()
    {
        $booking = session('hotel_booking');
        if (!$booking) {
            return redirect()->route('hotels.index')->with('error', 'No booking in progress.');
        }

        // Store pending booking data for payment
        session(['pending_hotel_booking' => $booking]);
        session()->forget('hotel_booking');

        return redirect()->route('payment.hotel.form');
    }

    // Step 4: Show payment form (reuse generic payment view)
    public function paymentForm()
    {
        $booking = session('pending_hotel_booking');
        if (!$booking) {
            return redirect()->route('hotels.index')->with('error', 'No booking data found.');
        }

        $total = $booking['total_price'];
        $type = 'hotel';
        $details = $booking;

        return view('payment.hotel_form', compact('total', 'type', 'details'));
    }

    // Step 5: Process payment and save booking
    public function processPayment(Request $request)
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

        // Create hotel booking
        $hotelBooking = HotelBooking::create([
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

    // Receipt page
    public function receipt(HotelBooking $hotelBooking)
    {
        $this->authorize('view', $hotelBooking);
        return view('hotels.receipt', compact('hotelBooking'));
    }

    // List user's hotel bookings
    public function myBookings()
    {
        $bookings = Auth::user()->hotelBookings()->with('hotel')->latest()->get();
        return view('hotels.my_bookings', compact('bookings'));
    }

    // Cancel booking
    public function cancel(HotelBooking $hotelBooking)
    {
        $this->authorize('update', $hotelBooking);
        $hotelBooking->update(['status' => 'cancelled']);
        return redirect()->route('hotel.my-bookings')->with('success', 'Booking cancelled.');
    }
}