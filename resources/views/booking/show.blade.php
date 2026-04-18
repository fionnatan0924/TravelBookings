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
    background: #f5f7fc;
    padding: 2rem;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    width: 100%;
}

.card {
    background: white;
    border-radius: 2rem;
    box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: box-shadow 0.2s;
}

.card-header {
    background: linear-gradient(135deg, #f8fafc, #ffffff);
    padding: 1.8rem 2rem;
    border-bottom: 1px solid #eff3f8;
}

.card-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1f3b4c;
    margin-bottom: 0.5rem;
    letter-spacing: -0.3px;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 1rem;
    border-radius: 40px;
    font-size: 0.8rem;
    font-weight: 600;
    background: #eef2fa;
    color: #2c5a7a;
}
.status-badge.confirmed {
    background: #d4edda;
    color: #155724;
}
.status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.card-body {
    padding: 2rem;
}

.flight-details, .passengers-list, .price-summary {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #edf2f7;
}

.flight-details h3, .passengers-list h3, .price-summary h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #1f4b6e;
    display: flex;
    align-items: center;
    gap: 8px;
}

.flight-details p, .price-summary p {
    margin: 0.5rem 0;
    font-size: 0.95rem;
    color: #2c5a7a;
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
}

.flight-details p strong, .price-summary p strong {
    width: 140px;
    font-weight: 600;
    color: #1f3b4c;
}

.passenger-item {
    background: #f8fafd;
    padding: 0.8rem 1rem;
    margin-bottom: 0.6rem;
    border-radius: 1rem;
    font-size: 0.9rem;
    transition: 0.2s;
    border: 1px solid #ecf3fa;
}
.passenger-item:hover {
    background: #f0f4fa;
    transform: translateX(4px);
}

.action-buttons {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.btn {
    padding: 0.6rem 1.5rem;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}

.btn-warning {
    background: #f0ad4e;
    color: white;
}
.btn-warning:hover {
    background: #e08e0e;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}
.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

@media (max-width: 680px) {
    body {
        padding: 1rem;
    }
    .card-header {
        padding: 1.2rem;
    }
    .card-header h1 {
        font-size: 1.4rem;
    }
    .card-body {
        padding: 1.2rem;
    }
    .flight-details p strong {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    .btn {
        justify-content: center;
    }
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

            <!-- Actions – only Cancel if not already cancelled -->
            <div class="action-buttons">
                @if($booking->status != 'cancelled')
                    <form action="{{ route('booking.cancel', $booking) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Cancel this booking?')">Cancel Booking</button>
                    </form>
                @endif

                <a href="{{ route('my-bookings') }}" class="btn btn-secondary">Back to My Bookings</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>