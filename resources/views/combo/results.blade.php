@extends('layouts.app')
@section('content')
<h2>Available Combos</h2>
@foreach($flights as $flight)
    @foreach($hotels as $hotel)
        <div class="combo-card">
            <h3>Flight: {{ $flight->origin }} → {{ $flight->destination }}</h3>
            <p>Departure: {{ $flight->departure_date }} | Price per passenger: RM{{ $flight->price }}</p>
            <h3>Hotel: {{ $hotel->name }} ({{ $hotel->stars }}★)</h3>
            <p>City: {{ $hotel->city }} | RM{{ $hotel->price_per_night }}/night</p>
            <form method="POST" action="{{ route('combo.book') }}">
                @csrf
                <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <button type="submit">Book this Combo</button>
            </form>
        </div>
    @endforeach
@endforeach
@endsection