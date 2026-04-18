@extends('layouts.app')

@section('title', 'Confirm Booking')

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h1><i class="fa-regular fa-calendar-check"></i> Confirm Your Booking</h1>
        <p>Review your hotel details before proceeding to payment</p>

        <div class="hotel-summary">
            <h2>{{ $hotel->name }}</h2>
            <div class="stars">{!! str_repeat('★', $hotel->stars) !!}</div>
            <p><i class="fa-solid fa-location-dot"></i> {{ $hotel->address }}, {{ $hotel->city }}</p>
            <div class="details-grid">
                <div><i class="fa-regular fa-calendar"></i> Check-in: <strong>{{ \Carbon\Carbon::parse($booking['check_in'])->format('d M Y') }}</strong></div>
                <div><i class="fa-regular fa-calendar"></i> Check-out: <strong>{{ \Carbon\Carbon::parse($booking['check_out'])->format('d M Y') }}</strong></div>
                <div><i class="fa-solid fa-users"></i> Guests: <strong>{{ $booking['guests'] }}</strong></div>
                <div><i class="fa-regular fa-clock"></i> Nights: <strong>{{ $booking['nights'] }}</strong></div>
            </div>
            <div class="price-breakdown">
                <span>Price per night: RM {{ number_format($hotel->price_per_night, 2) }}</span>
                <span>Total: <strong>RM {{ number_format($booking['total_price'], 2) }}</strong></span>
            </div>
        </div>

        <form action="{{ route('hotel.booking.payment') }}" method="POST">
            @csrf
            <button type="submit" class="confirm-btn">Proceed to Payment <i class="fa-solid fa-arrow-right"></i></button>
        </form>
        <a href="{{ route('hotels.show', $hotel) }}" class="back-link">← Back to hotel</a>
    </div>
</div>

<style>
    .confirm-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem;
    }
    .confirm-card {
        background: white;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 12px 28px rgba(0,0,0,0.1);
        text-align: center;
    }
    .confirm-card h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: #1f3b4c;
    }
    .hotel-summary {
        text-align: left;
        background: #f8fafc;
        border-radius: 1.2rem;
        padding: 1.5rem;
        margin: 1.5rem 0;
    }
    .hotel-summary h2 {
        font-size: 1.4rem;
        margin-bottom: 0.2rem;
    }
    .stars {
        color: #f5b042;
        margin-bottom: 0.5rem;
    }
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.8rem;
        margin: 1rem 0;
        padding: 0.5rem 0;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }
    .details-grid div {
        font-size: 0.95rem;
    }
    .price-breakdown {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        font-size: 1rem;
    }
    .price-breakdown strong {
        font-size: 1.2rem;
        color: #1f4b6e;
    }
    .confirm-btn {
        width: 100%;
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 40px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: 0.2s;
    }
    .confirm-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    }
    .back-link {
        display: inline-block;
        margin-top: 1rem;
        color: #6c7e94;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .back-link:hover {
        text-decoration: underline;
    }
</style>
@endsection