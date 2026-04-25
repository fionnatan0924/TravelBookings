@extends('layouts.app')
@section('title', 'All Bookings')
@section('content')
<div class="admin-bookings">
    <div class="page-header">
        <h1><i class="fa-solid fa-ticket"></i> All Bookings</h1>
        <p>View all bookings across the system</p>
    </div>

    <!-- Flight Bookings -->
    <div class="booking-section">
        <h2><i class="fa-solid fa-plane"></i> Flight Bookings</h2>
        @if($flightBookings->isEmpty())
            <p class="text-muted">No flight bookings found.</p>
        @else
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Flight</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flightBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->outboundFlight->origin }} → {{ $booking->outboundFlight->destination }}</td>
                        <td class="price">RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Hotel Bookings -->
    <div class="booking-section">
        <h2><i class="fa-solid fa-hotel"></i> Hotel Bookings</h2>
        @if($hotelBookings->isEmpty())
            <p class="text-muted">No hotel bookings found.</p>
        @else
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Hotel</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotelBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->hotel->name ?? 'N/A' }}</td>
                        <td class="price">RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Combo Bookings -->
    <div class="booking-section">
        <h2><i class="fa-solid fa-umbrella-beach"></i> Combo Bookings</h2>
        @if($comboBookings->isEmpty())
            <p class="text-muted">No combo bookings found.</p>
        @else
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Flight</th>
                        <th>Hotel</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comboBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</td>
                        <td>{{ $booking->hotel->name ?? 'N/A' }}</td>
                        <td class="price">RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Attraction Bookings -->
    <div class="booking-section">
        <h2><i class="fa-solid fa-tree"></i> Attraction Bookings</h2>
        @if($attractionBookings->isEmpty())
            <p class="text-muted">No attraction bookings found.</p>
        @else
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Attraction</th>
                        <th>Tickets</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attractionBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->attraction->name ?? 'N/A' }}</td>
                        <td>{{ $booking->number_of_people }}</td>
                        <td class="price">RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<style>
    .admin-bookings {
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
    .booking-section {
        margin-bottom: 2rem;
    }
    .booking-section h2 {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1f4b6e;
        margin-bottom: 1rem;
        padding-bottom: 0.3rem;
        border-bottom: 2px solid #eef2f8;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .text-muted {
        color: #6c7e94;
        text-align: center;
        padding: 2rem;
        background: #f8fafc;
        border-radius: 1rem;
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
    .price {
        font-weight: 700;
        color: #1f4b6e;
        white-space: nowrap;
    }
    .badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .badge.confirmed {
        background: #d4edda;
        color: #155724;
    }
    .badge.cancelled {
        background: #f8d7da;
        color: #b91c1c;
    }
    @media (max-width: 900px) {
        .admin-table th, .admin-table td {
            padding: 0.6rem;
            font-size: 0.85rem;
        }
    }
</style>
@endsection