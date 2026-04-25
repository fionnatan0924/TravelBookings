@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>

    <!-- Quick Action Cards -->
    <div class="action-cards">
        <a href="{{ route('admin.users') }}" class="action-card">
            <i class="fa-solid fa-users"></i>
            <span>Manage Users</span>
        </a>
        <a href="{{ route('admin.flights') }}" class="action-card">
            <i class="fa-solid fa-plane"></i>
            <span>Manage Flights</span>
        </a>
        <a href="{{ route('admin.hotels') }}" class="action-card">
            <i class="fa-solid fa-hotel"></i>
            <span>Manage Hotels</span>
        </a>
        <a href="{{ route('admin.bookings') }}" class="action-card">
            <i class="fa-solid fa-ticket"></i>
            <span>All Bookings</span>
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p>{{ $totalUsers }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Flights</h3>
            <p>{{ $totalFlights }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Hotels</h3>
            <p>{{ $totalHotels }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Bookings</h3>
            <p>{{ $totalBookings }}</p>
        </div>
    </div>

    <!-- Recent Bookings (all types) -->
    <div class="recent-section">
        <h2>Recent Bookings</h2>
        @if($recentBookings->isEmpty())
            <p class="text-muted">No recent bookings found.</p>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reference</th>
                        <th>Type</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>
                            @if(isset($booking->outboundFlight)) Flight
                            @elseif(isset($booking->hotel)) Hotel
                            @elseif(isset($booking->flight)) Combo
                            @else Attraction
                            @endif
                        </td>
                        <td>RM {{ number_format($booking->total_price, 2) }}</td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div style="margin-top: 1rem;">
            <a href="{{ route('admin.bookings') }}" class="btn-link">View All Bookings →</a>
        </div>
    </div>
</div>

<style>
    .admin-dashboard { max-width: 1200px; margin: 0 auto; padding: 1rem; }
    .action-cards { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem; }
    .action-card { background: white; border-radius: 1rem; padding: 1rem 1.5rem; text-align: center; text-decoration: none; color: #1f3b4c; flex: 1; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: 0.2s; }
    .action-card i { font-size: 1.8rem; margin-bottom: 0.5rem; display: block; }
    .action-card:hover { transform: translateY(-3px); background: #f8fafc; }
    .stats-grid { display: flex; gap: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap; }
    .stat-card { background: white; padding: 1.5rem; border-radius: 1rem; flex: 1; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .stat-card h3 { font-size: 1rem; color: #6c7e94; margin-bottom: 0.5rem; }
    .stat-card p { font-size: 2rem; font-weight: 700; color: #1f4b6e; }
    .recent-section { background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; }
    .admin-table { width: 100%; border-collapse: collapse; }
    .admin-table th, .admin-table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eef2f8; }
    .admin-table th { font-weight: 600; color: #1f3b4c; }
    .text-muted { color: #6c7e94; text-align: center; padding: 2rem; }
    .btn-link { color: #1f4b6e; text-decoration: none; font-weight: 600; }
    .btn-link:hover { text-decoration: underline; }
</style>
@endsection