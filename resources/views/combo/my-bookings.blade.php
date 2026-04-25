@extends('layouts.app')

@section('title', 'My Combo Bookings')

@section('content')
<div class="my-combo-bookings">
    <h1><i class="fa-solid fa-umbrella-beach"></i> My Combo Bookings</h1>
    @if($bookings->isEmpty())
        <p>You have no combo bookings yet.</p>
        <a href="{{ route('combo.index') }}" class="btn">Search for combos</a>
    @else
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="ref">{{ $booking->booking_reference }}</div>
                <div class="details">
                    Flight: {{ $booking->flight->origin }} → {{ $booking->flight->destination }}<br>
                    Hotel: {{ $booking->hotel->name }}<br>
                    {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }} – {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}
                </div>
                <div class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</div>
                <div class="price">RM {{ number_format($booking->total_price, 2) }}</div>
                <a href="{{ route('combo.show', $booking) }}" class="btn-sm">View</a>
                @if($booking->status == 'confirmed')
                    <form action="{{ route('combo.cancel', $booking) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="cancel-btn">Cancel</button>
                    </form>
                @endif
            </div>
        @endforeach
    @endif
</div>

<style>
    .my-combo-bookings { max-width: 1000px; margin: 0 auto; padding: 2rem; }
    .booking-card { background: white; border-radius: 1rem; padding: 1rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .ref { font-weight: bold; }
    .status.confirmed { color: green; }
    .status.cancelled { color: red; }
    .btn-sm { background: #0f2b3d; color: white; padding: 0.3rem 0.8rem; border-radius: 30px; text-decoration: none; }
    .cancel-btn { background: #e53e3e; color: white; border: none; padding: 0.3rem 0.8rem; border-radius: 30px; cursor: pointer; }
</style>
@endsection