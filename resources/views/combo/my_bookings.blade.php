@extends('layouts.app')
@section('content')
<h2>My Combo Bookings</h2>
@foreach($bookings as $booking)
    <div>
        Ref: {{ $booking->booking_reference }} | Flight: {{ $booking->flight->origin }} → {{ $booking->flight->destination }}
        | Hotel: {{ $booking->hotel->name }} | Status: {{ $booking->status }}
        <a href="{{ route('combo.show', $booking) }}">View</a>
    </div>
@endforeach
@endsection