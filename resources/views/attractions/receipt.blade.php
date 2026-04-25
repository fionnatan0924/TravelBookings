@extends('layouts.app')

@section('title', 'Attraction Booking Receipt')

@section('content')
<div class="receipt-container">
    <div class="receipt-card">
        <div class="success-icon"><i class="fa-regular fa-circle-check"></i></div>
        <h1>Booking Confirmed!</h1>
        <p>Thank you for booking with Travelio.</p>

        <div class="booking-info">
            <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
            <p><strong>Attraction:</strong> {{ $booking->attraction->name }}</p>
            <p><strong>Destination:</strong> {{ $booking->attraction->destination->name ?? 'N/A' }}</p>
            <p><strong>Tickets:</strong> {{ $booking->number_of_people }}</p>
            <p><strong>Total Paid:</strong> RM {{ number_format($booking->total_price, 2) }}</p>
            <p><strong>Booked on:</strong> {{ $booking->booking_date->format('d M Y, H:i') }}</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('attractions.index') }}" class="btn btn-secondary">Browse More Attractions</a>
            <a href="{{ route('my-bookings') }}" class="btn btn-primary">View My Bookings</a>
        </div>
    </div>
</div>

<style>
    .receipt-container { max-width: 600px; margin: 0 auto; padding: 2rem; }
    .receipt-card { background: white; border-radius: 1.5rem; padding: 2rem; text-align: center; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.08); }
    .success-icon { font-size: 4rem; color: #28a745; margin-bottom: 1rem; }
    .booking-info { background: #f8fafc; border-radius: 1rem; padding: 1rem; margin: 1.5rem 0; text-align: left; }
    .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 40px; text-decoration: none; margin: 0 0.5rem; }
    .btn-primary { background: #0f2b3d; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
</style>
@endsection