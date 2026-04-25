@extends('layouts.app')

@section('title', 'Add Hotel')

@section('content')
<div class="admin-form">
    <div class="page-header">
        <h1><i class="fa-solid fa-hotel"></i> Add New Hotel</h1>
        <p>Enter hotel details</p>
    </div>

    <form method="POST" action="{{ route('admin.hotels.store') }}">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Hotel Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" value="{{ old('city') }}" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="2" required>{{ old('address') }}</textarea>
            </div>
            <div class="form-group">
                <label>Price per night (RM)</label>
                <input type="number" name="price_per_night" step="0.01" value="{{ old('price_per_night') }}" required>
            </div>
            <div class="form-group">
                <label>Stars (1-5)</label>
                <input type="number" name="stars" min="1" max="5" value="{{ old('stars', 3) }}" required>
            </div>
            <div class="form-group">
                <label>Image URL (main photo)</label>
                <input type="url" name="image" value="{{ old('image') }}" placeholder="https://...">
            </div>
            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group full-width">
                <label>Gallery (JSON array of image URLs)</label>
                <input type="text" name="gallery" value="{{ old('gallery') }}" placeholder='["url1","url2"]'>
            </div>
            <div class="form-group">
                <label>Amenities (comma separated)</label>
                <input type="text" name="amenities" value="{{ old('amenities') }}" placeholder="Free Wi-Fi, Pool, Gym">
            </div>
            <div class="form-group">
                <label>Check-in Time</label>
                <input type="text" name="check_in_time" value="{{ old('check_in_time', '14:00') }}" placeholder="14:00">
            </div>
            <div class="form-group">
                <label>Check-out Time</label>
                <input type="text" name="check_out_time" value="{{ old('check_out_time', '12:00') }}" placeholder="12:00">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Create Hotel</button>
            <a href="{{ route('admin.hotels') }}" class="btn-secondary">Cancel</a>
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
        margin-bottom: 0.5rem;
    }
    .form-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #5b7e9c;
        margin-bottom: 0.3rem;
    }
    .form-group input, .form-group textarea, .form-group select {
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