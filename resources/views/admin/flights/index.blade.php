@extends('layouts.app')

@section('title', 'Manage Flights')

@section('content')
<div class="admin-flights">
    <div class="page-header">
        <h1><i class="fa-solid fa-plane"></i> Manage Flights</h1>
        <p>View and manage flight schedules</p>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Dep.</th>
                    <th>Arr.</th>
                    <th>Airline</th>
                    <th>Class</th>
                    <th>Price</th>
                    <th>Seats</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                <tr>
                    <td class="airport-code">{{ $flight->origin }}</td>
                    <td class="airport-code">{{ $flight->destination }}</td>
                    <td>{{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }}</td>
                    <td>{{ $flight->departure_time }}</td>
                    <td>{{ $flight->arrival_time }}</td>
                    <td class="airline-name">{{ $flight->airline }}</td>
                    <td><span class="class-badge {{ $flight->cabin_class }}">{{ ucfirst($flight->cabin_class) }}</span></td>
                    <td class="price">RM {{ number_format($flight->price, 2) }}</td>
                    <td class="seats">{{ $flight->available_seats }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.flights.edit', $flight) }}" class="btn-sm btn-edit">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.flights.delete', $flight) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Delete this flight?')">
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
        {{ $flights->links() }}
    </div>
</div>

<style>
    /* (all styles remain exactly the same as before) */
    .admin-flights {
        max-width: 1400px;
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
        padding: 0.85rem 0.75rem;
        text-align: left;
        border-bottom: 1px solid #eef2f8;
    }
    .admin-table th {
        background: #f8fafc;
        font-weight: 600;
        color: #1f3b4c;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .admin-table tr:hover {
        background: #fefefe;
    }
    .airport-code {
        font-weight: 600;
        color: #1f4b6e;
    }
    .airline-name {
        font-weight: 500;
    }
    .class-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .class-badge.economy { background: #eef2fa; color: #2c5a7a; }
    .class-badge.premium { background: #fff3e0; color: #e67e22; }
    .class-badge.business { background: #d4edda; color: #155724; }
    .class-badge.first { background: #f8d7da; color: #b91c1c; }
    .price {
        font-weight: 700;
        color: #1f4b6e;
    }
    .seats {
        font-weight: 600;
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

    @media (max-width: 900px) {
        .admin-table th, .admin-table td {
            padding: 0.6rem;
            font-size: 0.85rem;
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