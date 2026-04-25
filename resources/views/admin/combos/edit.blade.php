@extends('layouts.app')

@section('title', 'Edit Combo Booking')

@section('content')
<div class="admin-form">
    <div class="page-header">
        <h1><i class="fa-solid fa-pen"></i> Edit Combo Booking</h1>
        <p>Update booking status or details</p>
    </div>

    <form method="POST" action="{{ route('admin.combos.update', $comboBooking) }}">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Booking Reference</label>
                <input type="text" value="{{ $comboBooking->booking_reference }}" disabled>
            </div>
            <div class="form-group">
                <label>User</label>
                <input type="text" value="{{ $comboBooking->user->name ?? 'N/A' }}" disabled>
            </div>
            <div class="form-group">
                <label>Flight</label>
                <input type="text" value="{{ $comboBooking->flight->origin }} → {{ $comboBooking->flight->destination }}" disabled>
            </div>
            <div class="form-group">
                <label>Hotel</label>
                <input type="text" value="{{ $comboBooking->hotel->name ?? 'N/A' }}" disabled>
            </div>
            <div class="form-group">
                <label>Check-in Date</label>
                <input type="date" name="check_in_date" value="{{ old('check_in_date', $comboBooking->check_in_date->format('Y-m-d')) }}" required>
            </div>
            <div class="form-group">
                <label>Check-out Date</label>
                <input type="date" name="check_out_date" value="{{ old('check_out_date', $comboBooking->check_out_date->format('Y-m-d')) }}" required>
            </div>
            <div class="form-group">
                <label>Number of Guests</label>
                <input type="number" name="guests" value="{{ old('guests', $comboBooking->guests) }}" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="confirmed" {{ $comboBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $comboBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Update Booking</button>
            <a href="{{ route('admin.combos') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    /* reuse existing admin-form styles */
    .admin-form { max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
    .page-header { margin-bottom: 1.5rem; }
    .page-header h1 { font-size: 1.8rem; font-weight: 700; color: #1f3b4c; margin-bottom: 0.25rem; }
    .page-header p { color: #6c7e94; }
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .form-group { margin-bottom: 0.5rem; }
    .form-group label { display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: #5b7e9c; margin-bottom: 0.3rem; }
    .form-group input, .form-group select { width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 12px; font-family: inherit; }
    input[disabled] { background: #f8fafc; cursor: not-allowed; }
    .form-actions { display: flex; gap: 1rem; margin-top: 1.5rem; justify-content: flex-end; }
    .btn-primary { background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; padding: 0.6rem 1.2rem; border-radius: 40px; border: none; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,0.1); }
    .btn-secondary { background: #eef2fa; color: #2c5a7a; padding: 0.6rem 1.2rem; border-radius: 40px; text-decoration: none; font-weight: 600; transition: 0.2s; }
    .btn-secondary:hover { background: #e2e8f0; }
    @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
</style>
@endsection