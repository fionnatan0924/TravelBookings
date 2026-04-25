@extends('layouts.app')

@section('title', 'Add Combo Package')

@section('content')
<div class="admin-form">
    <div class="page-header">
        <h1><i class="fa-solid fa-plus"></i> Add Combo Package</h1>
        <p>Create a new flight+hotel package</p>
    </div>

    <form method="POST" action="{{ route('admin.packages.store') }}">
        @csrf

        <div class="form-grid">
            <div class="form-group full-width">
                <label>Package Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Destination</label>
                <select name="destination_id" required>
                    <option value="">Select destination</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Price (RM)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
            </div>
            <div class="form-group">
                <label>Duration (days)</label>
                <input type="number" name="duration_days" value="{{ old('duration_days', 1) }}" required>
            </div>
            <div class="form-group">
                <label>Duration (nights)</label>
                <input type="number" name="duration_nights" value="{{ old('duration_nights', 0) }}" required>
            </div>
            <div class="form-group">
                <label>Meal Plan</label>
                <input type="text" name="meal_plan" value="{{ old('meal_plan') }}" placeholder="e.g., Breakfast Only">
            </div>
            <div class="form-group">
                <label>Type / Category</label>
                <input type="text" name="type" value="{{ old('type') }}" placeholder="e.g., Relaxation, Adventure">
            </div>
            <div class="form-group">
                <label>Emoji (optional)</label>
                <input type="text" name="emoji" value="{{ old('emoji') }}" placeholder="🏖️">
            </div>
            <div class="form-group full-width">
                <label>Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://...">
            </div>
            <div class="form-group">
                <label>Featured?</label>
                <select name="is_featured">
                    <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label>Active?</label>
                <select name="is_active">
                    <option value="1" {{ old('is_active') != '0' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Create Package</button>
            <a href="{{ route('admin.packages') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    /* reuse same styles as admin/hotels/create – included for consistency */
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