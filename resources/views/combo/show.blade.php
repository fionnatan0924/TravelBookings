@extends('layouts.app')
@section('content')
<h1>Combo Booking #{{ $comboBooking->booking_reference }}</h1>
<p>Status: {{ $comboBooking->status }}</p>
<p>Flight: {{ $comboBooking->flight->origin }} → {{ $comboBooking->flight->destination }} on {{ $comboBooking->flight->departure_date }}</p>
<p>Hotel: {{ $comboBooking->hotel->name }}, Check-in: {{ $comboBooking->check_in_date }}, Check-out: {{ $comboBooking->check_out_date }}</p>
<p>Guests: {{ $comboBooking->guests }}</p>
<p>Total Price: RM{{ $comboBooking->total_price }}</p>
@if($comboBooking->status != 'cancelled')
    <form action="{{ route('combo.cancel', $comboBooking) }}" method="POST">
        @csrf @method('PATCH')
        <button type="submit">Cancel Combo</button>
    </form>
@endif
@endsection