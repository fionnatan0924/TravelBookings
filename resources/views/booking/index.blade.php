@extends('layouts.app')
@section('content')
<h2>My Bookings</h2>
@foreach($bookings as $booking)
    <div>
        Ref: {{ $booking->booking_reference }} | Flight: {{ $booking->outboundFlight->origin }} → {{ $booking->outboundFlight->destination }}
        | Status: {{ $booking->status }} | Total: RM{{ $booking->total_price }}
        <a href="{{ route('booking.show', $booking) }}">View</a>
    </div>
@endforeach
@endsection