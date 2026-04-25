@extends('layouts.app')

@section('title', 'Manage Combo Bookings')

@section('content')
<div class="admin-combos">
    <div class="page-header">
        <h1><i class="fa-solid fa-umbrella-beach"></i> Manage Combo Bookings</h1>
        <p>View, edit, or cancel user combo (flight+hotel) bookings</p>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Reference</th>
                    <th>Flight</th>
                    <th>Hotel</th>
                    <th>Dates</th>
                    <th>Guests</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Booked On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($combos as $combo)
                <tr>
                    <td>{{ $combo->user->name ?? 'N/A' }}</td>
                    <td class="ref">{{ $combo->booking_reference }}</td>
                    <td>{{ $combo->flight->origin }} → {{ $combo->flight->destination }}</td>
                    <td>{{ $combo->hotel->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($combo->check_in_date)->format('d M Y') }} → {{ \Carbon\Carbon::parse($combo->check_out_date)->format('d M Y') }}</td>
                    <td>{{ $combo->guests }}</td>
                    <td class="price">RM {{ number_format($combo->total_price, 2) }}</td>
                    <td><span class="badge {{ $combo->status }}">{{ ucfirst($combo->status) }}</span></td>
                    <td>{{ $combo->created_at->format('d M Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.combos.edit', $combo) }}" class="btn-sm btn-edit">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.combos.delete', $combo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Delete this combo booking?')">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $combos->links() }}
    </div>
</div>

<style>
    /* reuse existing admin styles – same as before */
    .admin-combos { max-width: 1400px; margin: 0 auto; padding: 0 1rem; }
    .page-header { margin-bottom: 1.5rem; }
    .page-header h1 { font-size: 1.8rem; font-weight: 700; color: #1f3b4c; margin-bottom: 0.25rem; }
    .page-header p { color: #6c7e94; }
    .table-responsive { overflow-x: auto; }
    .admin-table { width: 100%; border-collapse: collapse; background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .admin-table th, .admin-table td { padding: 0.85rem 0.75rem; text-align: left; border-bottom: 1px solid #eef2f8; }
    .admin-table th { background: #f8fafc; font-weight: 600; color: #1f3b4c; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .admin-table tr:hover { background: #fefefe; }
    .ref { font-family: monospace; font-weight: 600; }
    .price { font-weight: 700; color: #1f4b6e; white-space: nowrap; }
    .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 30px; font-size: 0.7rem; font-weight: 600; }
    .badge.confirmed { background: #d4edda; color: #155724; }
    .badge.cancelled { background: #f8d7da; color: #b91c1c; }
    .actions { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
    .btn-sm { padding: 0.3rem 0.8rem; border-radius: 30px; text-decoration: none; font-size: 0.75rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; transition: 0.2s; border: none; cursor: pointer; }
    .btn-edit { background: #eef2fa; color: #2c5a7a; }
    .btn-danger { background: #fee2e2; color: #b91c1c; }
    .btn-danger:hover { background: #fecaca; }
    .pagination-wrapper { margin-top: 2rem; display: flex; justify-content: center; }
    .pagination-wrapper .pagination { gap: 0.3rem; }
    .pagination-wrapper .page-link { border-radius: 30px !important; border: none; color: #2c5a7a; font-weight: 500; padding: 0.4rem 0.8rem; }
    .pagination-wrapper .page-item.active .page-link { background: #0f2b3d; color: white; }
    @media (max-width: 900px) { .admin-table th, .admin-table td { padding: 0.6rem; font-size: 0.85rem; } .actions { flex-direction: column; align-items: flex-start; gap: 0.3rem; } .btn-sm { width: 100%; justify-content: center; } }
</style>
@endsection