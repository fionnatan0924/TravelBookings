@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="admin-users">
    <div class="page-header">
        <h1><i class="fa-solid fa-users"></i> Manage Users</h1>
        <p>View, edit, and manage user accounts</p>
    </div>

    <div class="actions-bar">
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fa-solid fa-user-plus"></i> Add New User
        </a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="user-name">{{ $user->name }}</td>
                    <td class="user-email">{{ $user->email }}</td>
                    <td><span class="role-badge {{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm btn-edit">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>
</div>

<style>
    .admin-users {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
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

    .actions-bar {
        margin-bottom: 1.5rem;
    }
    .btn-primary {
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        transition: 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    }

    .table-responsive {
        overflow-x: auto;
    }
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .admin-table th,
    .admin-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eef2f8;
    }
    .admin-table th {
        background: #f8fafc;
        font-weight: 600;
        color: #1f3b4c;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .admin-table tr:hover {
        background: #fefefe;
    }
    .user-name {
        font-weight: 600;
        color: #1e2f3e;
    }
    .user-email {
        color: #4a627a;
    }
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .role-badge.admin {
        background: #d4edda;
        color: #155724;
    }
    .role-badge.user {
        background: #eef2fa;
        color: #2c5a7a;
    }
    .actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .btn-sm {
        padding: 0.3rem 0.8rem;
        border-radius: 30px;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-edit {
        background: #eef2fa;
        color: #2c5a7a;
    }
    .btn-edit:hover {
        background: #e2e8f0;
    }
    .btn-danger {
        background: #fee2e2;
        color: #b91c1c;
    }
    .btn-danger:hover {
        background: #fecaca;
    }

    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper .pagination {
        gap: 0.3rem;
    }
    .pagination-wrapper .page-link {
        border-radius: 30px !important;
        border: none;
        color: #2c5a7a;
        font-weight: 500;
        padding: 0.4rem 0.8rem;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #0f2b3d;
        color: white;
    }

    @media (max-width: 768px) {
        .admin-table th, .admin-table td {
            padding: 0.75rem;
        }
        .actions {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.3rem;
        }
        .btn-sm {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection