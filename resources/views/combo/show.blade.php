@extends('layouts.app')

@section('title', 'Combo Booking Details')

@section('content')
<div class="combo-details">
    <h1>Combo Booking #{{ $comboBooking->booking_reference }}</h1>
    <p class="status">Status: {{ ucfirst($comboBooking->status) }}</p>

    <div class="flight-info">
        <h3><i class="fa-solid fa-plane-departure"></i> Flight</h3>
        <p>{{ $comboBooking->flight->origin }} → {{ $comboBooking->flight->destination }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($comboBooking->flight->departure_date)->format('d M Y') }}</p>
        <p>Time: {{ \Carbon\Carbon::parse($comboBooking->flight->departure_time)->format('H:i') }}</p>
        <p>Class: {{ ucfirst($comboBooking->flight->cabin_class) }}</p>
    </div>

    <div class="hotel-info">
        <h3><i class="fa-solid fa-hotel"></i> Hotel</h3>
        <p>{{ $comboBooking->hotel->name }}</p>
        <p>City: {{ $comboBooking->hotel->city }}</p>
        <p>Check-in: {{ \Carbon\Carbon::parse($comboBooking->check_in_date)->format('d M Y') }}</p>
        <p>Check-out: {{ \Carbon\Carbon::parse($comboBooking->check_out_date)->format('d M Y') }}</p>
        <p>Guests: {{ $comboBooking->guests }}</p>
    </div>

    <div class="passengers">
    <h3>Passengers</h3>
    @foreach($comboBooking->passengers as $passenger)
        <p>{{ ucfirst($passenger->type) }}: {{ $passenger->full_name }} (DOB: {{ \Carbon\Carbon::parse($passenger->dob)->format('d M Y') }}, Passport: {{ $passenger->passport_number ?? 'N/A' }})</p>
    @endforeach
</div>

    <div class="price">
        <h3>Total Price: RM {{ number_format($comboBooking->total_price, 2) }}</h3>
    </div>

    @if($comboBooking->status != 'cancelled')
        <form action="{{ route('combo.cancel', $comboBooking) }}" method="POST">
            @csrf
            @method('PATCH')
            <button class="cancel-btn">Cancel Combo</button>
        </form>
    @endif

    <a href="{{ route('my-bookings') }}" class="back-btn">Back To My Booking</a>
</div>

<style>
    .combo-details { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
    h1 { margin-bottom: 0.5rem; }
    .status { display: inline-block; background: #d4edda; padding: 0.2rem 0.8rem; border-radius: 20px; font-weight: 600; margin-bottom: 1rem; }
    .flight-info, .hotel-info { margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #eef2f8; }
    .price { margin-bottom: 1rem; }
    .cancel-btn, .back-btn { background: #dc3545; color: white; border: none; padding: 0.5rem 1rem; border-radius: 30px; cursor: pointer; margin-right: 1rem; }
    .back-btn { background: #6c757d; text-decoration: none; display: inline-block; }
</style>
@endsection