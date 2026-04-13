@extends('layouts.app')
@section('content')
<h1>Booking {{ $booking->booking_reference }}</h1>
<p>Status: {{ $booking->status }}</p>
<p>Total: RM{{ $booking->total_price }}</p>
@if($booking->status != 'cancelled')
    <form action="{{ route('booking.cancel', $booking) }}" method="POST">
        @csrf @method('PATCH')
        <button type="submit">Cancel Booking</button>
    </form>
@endif
<form action="{{ route('booking.destroy', $booking) }}" method="POST">
    @csrf @method('DELETE')
    <button type="submit">Delete Permanently</button>
</form>
@endsection