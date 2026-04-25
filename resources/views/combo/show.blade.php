@extends('layouts.app')

@section('title', 'Combo Booking Details')

@section('content')
<div class="combo-detail">
    <div class="detail-card">
        <div class="success-icon"><i class="fa-regular fa-circle-check"></i></div>
        <h1>Booking Confirmed!</h1>
        <p>Your combo booking is confirmed. Reference: <strong>{{ $comboBooking->booking_reference }}</strong></p>

        <div class="booking-info">
            <h3><i class="fa-solid fa-plane-departure"></i> Flight</h3>
            <p>{{ $comboBooking->flight->airline }}: {{ $comboBooking->flight->origin }} → {{ $comboBooking->flight->destination }}</p>
            <p>Departure: {{ \Carbon\Carbon::parse($comboBooking->flight->departure_date)->format('d M Y') }} at {{ \Carbon\Carbon::parse($comboBooking->flight->departure_time)->format('H:i') }}</p>

            <h3><i class="fa-solid fa-hotel"></i> Hotel</h3>
            <p>{{ $comboBooking->hotel->name }} ({{ $comboBooking->hotel->city }})</p>
            <p>Check‑in: {{ \Carbon\Carbon::parse($comboBooking->check_in_date)->format('d M Y') }}</p>
            <p>Check‑out: {{ \Carbon\Carbon::parse($comboBooking->check_out_date)->format('d M Y') }}</p>
            <p>Guests: {{ $comboBooking->guests }}</p>

            <h3>Passengers</h3>
            @foreach($comboBooking->passengers as $p)
                <p>{{ ucfirst($p->type) }}: {{ $p->full_name }}</p>
            @endforeach

            <div class="total">Total Paid: RM {{ number_format($comboBooking->total_price, 2) }}</div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('my-bookings') }}" class="btn">Back to My Bookings</a>
            <a href="{{ route('combo.index') }}" class="btn-secondary">Book Another Combo</a>
        </div>
    </div>
</div>

<style>
    .combo-detail { max-width: 800px; margin: 0 auto; padding: 2rem; }
    .detail-card { background: white; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.08); text-align: center; }
    .success-icon { font-size: 4rem; color: #28a745; margin-bottom: 1rem; }
    .booking-info { text-align: left; background: #f8fafc; border-radius: 1rem; padding: 1rem; margin: 1rem 0; }
    .total { font-size: 1.2rem; font-weight: bold; margin-top: 1rem; }
    .btn, .btn-secondary { display: inline-block; margin: 0.5rem; padding: 0.5rem 1rem; border-radius: 40px; text-decoration: none; }
    .btn { background: #0f2b3d; color: white; }
    .btn-secondary { background: #6c757d; color: white; }
</style>
@endsection