@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="bookings-container">
    <h1><i class="fa-solid fa-ticket"></i> My Bookings</h1>
    <p>All your reservations in one place</p>

    @if($allBookings->isEmpty())
        <div class="no-bookings">
            <i class="fa-regular fa-calendar-xmark"></i>
            <p>You have no bookings yet.</p>
            <a href="{{ route('flights.search') }}" class="btn">Book a flight</a>
            <a href="{{ route('hotels.index') }}" class="btn-secondary">Book a hotel</a>
        </div>
    @else
        <div class="bookings-list">
            @foreach($allBookings as $booking)
                <div class="booking-card {{ $booking->type }}">
                    <div class="booking-type">
                        @if($booking->type == 'flight')
                            <i class="fa-solid fa-plane"></i> Flight
                        @elseif($booking->type == 'combo')
                            <i class="fa-solid fa-umbrella-beach"></i> Combo
                        @elseif($booking->type == 'hotel')
                            <i class="fa-solid fa-hotel"></i> Hotel
                        @elseif($booking->type == 'attraction')
                            <i class="fa-solid fa-ticket"></i> Attraction
                        @endif
                    </div>
                    <div class="booking-info">
                        <div class="title">{{ $booking->display_title }}</div>
                        <div class="ref">Ref: {{ $booking->booking_reference }}</div>
                        <div class="date">Booked on: {{ \Carbon\Carbon::parse($booking->display_date)->format('d M Y, H:i') }}</div>
                        <div class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</div>
                        <div class="price">RM {{ number_format($booking->total_price, 2) }}</div>
                    </div>
                    <div class="booking-actions">
                        @if($booking->type == 'flight')
                            <a href="{{ route('booking.show', $booking) }}" class="btn-sm">View details</a>
                        @elseif($booking->type == 'combo')
                            <a href="{{ route('combo.show', $booking) }}" class="btn-sm">View details</a>
                        @elseif($booking->type == 'hotel')
                            <a href="{{ route('hotel.receipt', $booking) }}" class="btn-sm">View details</a>
                        @elseif($booking->type == 'attraction')
                            <a href="{{ route('attraction.receipt', $booking->id) }}" class="btn-sm">View receipt</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .bookings-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }
    h1 {
        font-size: 2rem;
        margin-bottom: 0.3rem;
    }
    .bookings-list {
        margin-top: 2rem;
    }
    .booking-card {
        background: white;
        border-radius: 1.2rem;
        padding: 1.2rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: 0.2s;
        border-left: 6px solid;
    }
    .booking-card.flight { border-left-color: #3498db; }
    .booking-card.combo { border-left-color: #e67e22; }
    .booking-card.hotel { border-left-color: #2ecc71; }
    .booking-card.attraction { border-left-color: #9b59b6; }
    .booking-type {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #6c7e94;
        min-width: 80px;
    }
    .booking-info {
        flex: 2;
    }
    .title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.2rem;
    }
    .ref, .date {
        font-size: 0.8rem;
        color: #6c7e94;
    }
    .status {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 0.3rem;
    }
    .status.confirmed { background: #d4edda; color: #155724; }
    .status.cancelled { background: #f8d7da; color: #721c24; }
    .price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f4b6e;
        margin-top: 0.3rem;
    }
    .btn-sm {
        background: #0f2b3d;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 30px;
        text-decoration: none;
        font-size: 0.8rem;
    }
    .btn-sm:hover {
        background: #1f4b6e;
    }
    .no-bookings {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 1.5rem;
    }
    .no-bookings i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }
    .btn, .btn-secondary {
        display: inline-block;
        margin: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        text-decoration: none;
    }
    .btn {
        background: #0f2b3d;
        color: white;
    }
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
</style>
@endsection