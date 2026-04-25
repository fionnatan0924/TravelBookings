@extends('layouts.app')

@section('content')
<div class="admin-form">
    <h1>Add Flight</h1>
    <form method="POST" action="{{ route('admin.flights.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group"><label>Origin (code)</label><input type="text" name="origin" required></div>
            <div class="form-group"><label>Destination (code)</label><input type="text" name="destination" required></div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Departure Date</label><input type="date" name="departure_date" required></div>
            <div class="form-group"><label>Departure Time</label><input type="time" name="departure_time" required></div>
            <div class="form-group"><label>Arrival Time</label><input type="time" name="arrival_time" required></div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Airline</label><input type="text" name="airline" required></div>
            <div class="form-group"><label>Cabin Class</label>
                <select name="cabin_class"><option value="economy">Economy</option><option value="premium">Premium</option><option value="business">Business</option><option value="first">First</option></select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Price (RM)</label><input type="number" name="price" step="0.01" required></div>
            <div class="form-group"><label>Available Seats</label><input type="number" name="available_seats" required></div>
        </div>
        <div class="form-group"><label>Duration (e.g., 2h 30m)</label><input type="text" name="duration"></div>
        <div class="form-group"><label>Origin Terminal</label><input type="text" name="origin_terminal"></div>
        <div class="form-group"><label>Destination Terminal</label><input type="text" name="destination_terminal"></div>
        <div class="form-group"><label>Baggage Info</label><input type="text" name="baggage"></div>
        <button type="submit" class="btn-primary">Create Flight</button>
    </form>
</div>
<style>/* same as user form */</style>
@endsection