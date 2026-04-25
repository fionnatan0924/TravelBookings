@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="admin-form">
    <h1>Create New User</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Create User</button>
    </form>
</div>

<style>
    .admin-form { max-width: 500px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1.5rem; }
    .form-group { margin-bottom: 1rem; }
    label { display: block; font-weight: 600; margin-bottom: 0.3rem; }
    input, select { width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 12px; }
    .btn-primary { background: #0f2b3d; color: white; padding: 0.6rem 1.2rem; border-radius: 40px; border: none; cursor: pointer; }
</style>
@endsection