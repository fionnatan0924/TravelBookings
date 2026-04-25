@extends('layouts.app')

@section('title', 'Edit Flight')

@section('content')
<div class="admin-form">
    <div class="page-header">
        <h1><i class="fa-solid fa-plane"></i> Edit Flight</h1>
        <p>Update flight information</p>
    </div>

    <form method="POST" action="{{ route('admin.flights.update', $flight) }}">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Origin (airport code)</label>
                <input type="text" name="origin" value="{{ old('origin', $flight->origin) }}" required>
            </div>
            <div class="form-group">
                <label>Destination (airport code)</label>
                <input type="text" name="destination" value="{{ old('destination', $flight->destination) }}" required>
            </div>
            <div class="form-group">
                <label>Departure Date</label>
                <input type="date" name="departure_date" value="{{ old('departure_date', $flight->departure_date) }}" required>
            </div>
            <div class="form-group">
                <label>Departure Time</label>
                <input type="time" name="departure_time" value="{{ old('departure_time', $flight->departure_time) }}" required>
            </div>
            <div class="form-group">
                <label>Arrival Time</label>
                <input type="time" name="arrival_time" value="{{ old('arrival_time', $flight->arrival_time) }}" required>
            </div>
            <div class="form-group">
                <label>Airline</label>
                <input type="text" name="airline" value="{{ old('airline', $flight->airline) }}" required>
            </div>
            <div class="form-group">
                <label>Cabin Class</label>
                <select name="cabin_class" required>
                    <option value="economy" {{ $flight->cabin_class == 'economy' ? 'selected' : '' }}>Economy</option>
                    <option value="premium" {{ $flight->cabin_class == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="business" {{ $flight->cabin_class == 'business' ? 'selected' : '' }}>Business</option>
                    <option value="first" {{ $flight->cabin_class == 'first' ? 'selected' : '' }}>First</option>
                </select>
            </div>
            <div class="form-group">
                <label>Price (RM)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $flight->price) }}" required>
            </div>
            <div class="form-group">
                <label>Available Seats</label>
                <input type="number" name="available_seats" value="{{ old('available_seats', $flight->available_seats) }}" required>
            </div>
            <div class="form-group">
                <label>Duration (e.g., 2h 30m)</label>
                <input type="text" name="duration" value="{{ old('duration', $flight->duration) }}">
            </div>
            <div class="form-group">
                <label>Origin Terminal</label>
                <input type="text" name="origin_terminal" value="{{ old('origin_terminal', $flight->origin_terminal) }}">
            </div>
            <div class="form-group">
                <label>Destination Terminal</label>
                <input type="text" name="destination_terminal" value="{{ old('destination_terminal', $flight->destination_terminal) }}">
            </div>
            <div class="form-group full-width">
                <label>Baggage Info</label>
                <input type="text" name="baggage" value="{{ old('baggage', $flight->baggage) }}">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Update Flight</button>
            <a href="{{ route('admin.flights') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    .admin-form {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }
    .page-header {
        margin-bottom: 1.5rem;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1f3b4c;
        margin-bottom: 0.25rem;
    }
    .page-header p {
        color: #6c7e94;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .form-group.full-width {
        grid-column: span 2;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #5b7e9c;
        margin-bottom: 0.3rem;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-family: inherit;
    }
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        justify-content: flex-end;
    }
    .btn-primary {
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    }
    .btn-secondary {
        background: #eef2fa;
        color: #2c5a7a;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-secondary:hover {
        background: #e2e8f0;
    }
    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-group.full-width {
            grid-column: span 1;
        }
    }
</style>
@endsection