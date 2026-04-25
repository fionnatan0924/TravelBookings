@extends('layouts.app')

@section('title', 'Confirm Your Booking')

@section('content')
<div class="confirm-container">
    <div class="confirm-card">
        <h1><i class="fa-regular fa-calendar-check"></i> Confirm Your Attraction Booking</h1>
        <p>Review your details before proceeding to payment</p>

        <div class="attraction-summary">
            <h2>{{ $attraction->name }}</h2>
            <p><i class="fa-solid fa-location-dot"></i> {{ $booking['destination'] ?? $attraction->destination->name }}</p>
            <div class="details-grid">
                <div><i class="fa-solid fa-ticket"></i> Tickets: <strong>{{ $booking['number_of_people'] }}</strong></div>
                <div><i class="fa-solid fa-dollar-sign"></i> Price per ticket: <strong>RM {{ number_format($attraction->price, 2) }}</strong></div>
                <div><i class="fa-solid fa-receipt"></i> Total: <strong>RM {{ number_format($booking['total_price'], 2) }}</strong></div>
            </div>
        </div>

        <form action="{{ route('attraction.booking.payment') }}" method="POST">
            @csrf
            <button type="submit" class="confirm-btn">Proceed to Payment <i class="fa-solid fa-arrow-right"></i></button>
        </form>
        <a href="{{ route('attractions.show', $attraction->id) }}" class="back-link">← Back to attraction</a>
    </div>
</div>

<style>
    .confirm-container { max-width: 600px; margin: 0 auto; padding: 2rem; }
    .confirm-card { background: white; border-radius: 1.5rem; padding: 2rem; text-align: center; box-shadow: 0 12px 28px rgba(0,0,0,0.1); }
    .attraction-summary { background: #f8fafc; border-radius: 1.2rem; padding: 1.5rem; margin: 1.5rem 0; text-align: left; }
    .details-grid { display: flex; flex-direction: column; gap: 0.5rem; margin-top: 1rem; }
    .confirm-btn { background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; border: none; padding: 0.8rem; border-radius: 40px; font-weight: 700; width: 100%; cursor: pointer; }
    .back-link { display: inline-block; margin-top: 1rem; color: #6c7e94; }
</style>
@endsection