@extends('layouts.app')

@section('title', 'Hotel Booking Receipt')

@section('content')
<div class="receipt">
    <div class="receipt-card">
        <div class="success-icon"><i class="fa-regular fa-circle-check"></i></div>
        <h1>Payment Successful!</h1>
        <p>Your hotel booking is confirmed.</p>

        <div class="booking-info">
            <h3>Booking Reference: {{ $hotelBooking->booking_reference }}</h3>
            <p><strong>Hotel:</strong> {{ $hotelBooking->hotel->name }}</p>
            <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($hotelBooking->check_in)->format('d M Y') }}</p>
            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($hotelBooking->check_out)->format('d M Y') }}</p>
            <p><strong>Guests:</strong> {{ $hotelBooking->guests }}</p>
            <p><strong>Total Paid:</strong> RM {{ number_format($hotelBooking->total_price, 2) }}</p>
        </div>

        <a href="{{ route('my-bookings') }}" class="btn">View My Bookings</a>
        <a href="{{ route('hotels.index') }}" class="btn-secondary">Back to Hotel</a>
    </div>
</div>

<style>
    .receipt { max-width: 600px; margin: 0 auto; padding: 2rem; }
    .receipt-card { background: white; border-radius: 1.5rem; padding: 2rem; text-align: center; }
    .success-icon { font-size: 4rem; color: #28a745; margin-bottom: 1rem; }
    .booking-info { background: #f8fafc; border-radius: 1rem; padding: 1rem; margin: 1.5rem 0; text-align: left; }
    .btn, .btn-secondary { display: inline-block; margin: 0.5rem; padding: 0.5rem 1rem; border-radius: 40px; text-decoration: none; }
    .btn { background: #0f2b3d; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
</style>
@endsection