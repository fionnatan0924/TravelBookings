@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 2rem;
        margin-top: 1rem;
    }
    @media (max-width: 900px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
    .profile-card, .settings-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .profile-header {
        background: linear-gradient(135deg, #1f3b4c, #2c6e9e);
        padding: 2rem;
        color: white;
        text-align: center;
    }
    .avatar-large {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid white;
        margin-bottom: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .profile-body {
        padding: 2rem;
    }
    .info-row {
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eef2f8;
    }
    .info-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #5b7e9c;
    }
    .info-value {
        font-size: 1rem;
        font-weight: 500;
        color: #1e2f3e;
        margin-top: 0.2rem;
    }
    .settings-card {
        padding: 2rem;
    }
    .settings-card h3 {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #1f3b4c;
    }
    .form-group {
        margin-bottom: 1.2rem;
    }
    .form-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #5b7e9c;
        margin-bottom: 0.3rem;
    }
    .form-group input {
        width: 100%;
        padding: 0.7rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
    }
    .btn-primary {
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
    }
    .btn-danger {
        background: #e53e3e;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 1rem;
    }
    .password-section {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #eef2f8;
    }
</style>

<div class="container">

    <div class="profile-grid">
        <!-- LEFT COLUMN: Profile info -->
        <div class="profile-card">
            <div class="profile-header">
                <img src="https://ui-avatars.com/api/?background=2c6e9e&color=fff&name={{ urlencode(Auth::user()->name) }}&size=100" class="avatar-large" alt="Avatar">
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
                <p><small>Member since {{ Auth::user()->created_at->format('d M Y') }}</small></p>
            </div>
            <div class="profile-body">
                <div class="info-row">
                    <div class="info-label">Account Status</div>
                    <div class="info-value"><span class="status-badge confirmed">Active</span></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email Verified</div>
                    <div class="info-value">{{ Auth::user()->email_verified_at ? 'Yes' : 'No' }}</div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Settings (update profile + change password) -->
        <div class="settings-card">
            <h3><i class="fa-regular fa-user"></i> Account Settings</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>
                <button type="submit" class="btn-primary">Update Profile</button>
            </form>

            <div class="password-section">
                <h3><i class="fa-solid fa-lock"></i> Change Password</h3>
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .status-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .status-badge.confirmed {
        background: #d4edda;
        color: #155724;
    }
</style>
@endsection
