<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details - Travelio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f6fc;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .card-header {
            background: #f8fafc;
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .card-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 1.6rem;
        }
        .status-badge {
            display: inline-block;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .status-badge.confirmed { background: #d4edda; color: #155724; }
        .status-badge.cancelled { background: #f8d7da; color: #721c24; }
        .card-body { padding: 1.5rem; }
        .flight-details, .passengers-list, .price-summary {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eef2f8;
        }
        .flight-details h3, .passengers-list h3, .price-summary h3 {
            color: #1f4b6e;
            margin-bottom: 1rem;
        }
        .passenger-item {
            background: #f9f9ff;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
        }
        .action-buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .btn {
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-block;
        }
        .btn-warning {
            background: #f0ad4e;
            color: white;
        }
        .btn-danger {
            background: #d9534f;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Booking Reference: {{ $booking->booking_reference }}</h1>
            <p class="status-badge {{ $booking->status }}">Status: {{ ucfirst($booking->status) }}</p>
        </div>

        <div class="card-body">
            <!-- Outbound Flight -->
            <div class="flight-details">
                <h3><i class="fa-solid fa-plane-departure"></i> Outbound Flight</h3>
                <p><strong>Airline:</strong> {{ $booking->outboundFlight->airline ?? 'N/A' }}</p>
                <p><strong>Route:</strong> {{ $booking->outboundFlight->origin }} → {{ $booking->outboundFlight->destination }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->outboundFlight->departure_date)->format('d M Y') }}</p>
                <p><strong>Departure:</strong> {{ \Carbon\Carbon::parse($booking->outboundFlight->departure_time)->format('H:i') }}</p>
                <p><strong>Arrival:</strong> {{ \Carbon\Carbon::parse($booking->outboundFlight->arrival_time)->format('H:i') }}</p>
                <p><strong>Cabin Class:</strong> {{ ucfirst($booking->outboundFlight->cabin_class) }}</p>
            </div>

            <!-- Return Flight (if exists) -->
            @if($booking->returnFlight)
                <div class="flight-details">
                    <h3><i class="fa-solid fa-plane-return"></i> Return Flight</h3>
                    <p><strong>Airline:</strong> {{ $booking->returnFlight->airline ?? 'N/A' }}</p>
                    <p><strong>Route:</strong> {{ $booking->returnFlight->origin }} → {{ $booking->returnFlight->destination }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->returnFlight->departure_date)->format('d M Y') }}</p>
                    <p><strong>Departure:</strong> {{ \Carbon\Carbon::parse($booking->returnFlight->departure_time)->format('H:i') }}</p>
                    <p><strong>Arrival:</strong> {{ \Carbon\Carbon::parse($booking->returnFlight->arrival_time)->format('H:i') }}</p>
                    <p><strong>Cabin Class:</strong> {{ ucfirst($booking->returnFlight->cabin_class) }}</p>
                </div>
            @endif

            <!-- Passengers -->
            <div class="passengers-list">
                <h3><i class="fa-solid fa-users"></i> Passengers</h3>
                @foreach($booking->passengers as $passenger)
                    <div class="passenger-item">
                        <strong>{{ ucfirst($passenger->type) }}:</strong> {{ $passenger->full_name }}
                        (DOB: {{ \Carbon\Carbon::parse($passenger->dob)->format('d M Y') }},
                        Nationality: {{ $passenger->nationality }},
                        Passport: {{ $passenger->passport_number ?? 'N/A' }})
                    </div>
                @endforeach
            </div>

            <!-- Price Summary -->
            <div class="price-summary">
                <h3><i class="fa-solid fa-receipt"></i> Price Summary</h3>
                <p><strong>Luggage:</strong> {{ $booking->luggage_option === 'yes' ? 'Added (RM ' . number_format($booking->luggage_cost, 2) . ')' : 'Not added' }}</p>
                <p><strong>Base Flight Price (per adult):</strong> RM {{ number_format($booking->outboundFlight->price, 2) }}</p>
                @if($booking->returnFlight)
                    <p><strong>Return Flight Price (per adult):</strong> RM {{ number_format($booking->returnFlight->price, 2) }}</p>
                @endif
                <p><strong>Total Paid:</strong> RM {{ number_format($booking->total_price, 2) }}</p>
                <p><strong>Booked on:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, H:i') }}</p>
            </div>

            <!-- Actions -->
            <div class="action-buttons">
                @if($booking->status != 'cancelled')
                    <form action="{{ route('booking.cancel', $booking) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Cancel this booking?')">Cancel Booking</button>
                    </form>
                @endif

                <form action="{{ route('booking.destroy', $booking) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Permanently delete this booking? This cannot be undone.')">Delete Permanently</button>
                </form>

                <a href="{{ route('booking.index') }}" class="btn btn-secondary">Back to My Bookings</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>