@extends('layouts.app')

@section('title', 'My Combo Bookings')

@section('content')
<h1>My Combo Bookings</h1>
@if($bookings->isEmpty())
    <p>You have no combo bookings yet.</p>
@else
    @foreach($bookings as $booking)
        <div class="booking-card">
            <div class="ref">{{ $booking->booking_reference }}</div>
            <div class="details">
                {{ $booking->flight->origin }} → {{ $booking->flight->destination }} |
                {{ $booking->hotel->name }} |
                {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M') }} - {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}
            </div>
            <div class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</div>
            <div class="price">RM {{ number_format($booking->total_price, 2) }}</div>
            <a href="{{ route('combo.show', $booking) }}" class="btn">View</a>
        </div>
    @endforeach
@endif
<style>
    .booking-card { background: white; border-radius: 1rem; padding: 1rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .ref { font-weight: bold; }
    .status.confirmed { color: green; }
    .status.cancelled { color: red; }
    .btn { background: #0f2b3d; color: white; padding: 0.3rem 1rem; border-radius: 30px; text-decoration: none; }
</style>
@endsection