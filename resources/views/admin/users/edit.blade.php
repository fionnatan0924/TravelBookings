@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="admin-form">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update User</button>
        <a href="{{ route('admin.users') }}" class="btn-secondary">Cancel</a>
    </form>
</div>

<style>
    .admin-form { max-width: 500px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1.5rem; }
    .form-group { margin-bottom: 1rem; }
    label { display: block; font-weight: 600; margin-bottom: 0.3rem; }
    input, select { width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 12px; }
    .btn-primary { background: #0f2b3d; color: white; padding: 0.6rem 1.2rem; border-radius: 40px; border: none; cursor: pointer; }
    .btn-secondary { background: #eef2fa; color: #2c5a7a; padding: 0.6rem 1.2rem; border-radius: 40px; text-decoration: none; margin-left: 0.5rem; }
</style>
@endsection