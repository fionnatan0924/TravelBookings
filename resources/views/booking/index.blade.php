<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - Travelio</title>
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
            max-width: 1100px;
            margin: 0 auto;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #1f4b6e;
        }
        .booking-card {
            background: white;
            border-radius: 1rem;
            padding: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .booking-info {
            flex: 1;
        }
        .booking-ref {
            font-weight: 700;
            font-size: 1.1rem;
        }
        .flight-route {
            color: #2c5a7a;
            margin: 0.3rem 0;
        }
        .status {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status.confirmed { background: #d4edda; color: #155724; }
        .status.cancelled { background: #f8d7da; color: #721c24; }
        .price {
            font-weight: 700;
            font-size: 1.2rem;
            color: #1f4b6e;
        }
        .btn {
            padding: 0.4rem 1rem;
            border-radius: 30px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .btn-primary {
            background: #0f2b3d;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .no-bookings {
            background: white;
            padding: 2rem;
            text-align: center;
            border-radius: 1rem;
            color: #6c7e94;
        }
    </style>
</head>
<body>
<div class="container">
    <h1><i class="fa-solid fa-ticket"></i> My Flight Bookings</h1>

    @if($bookings->isEmpty())
        <div class="no-bookings">
            <p>You have no flight bookings yet.</p>
            <a href="{{ route('flights.search') }}" class="btn btn-primary" style="display: inline-block; margin-top: 1rem;">Search Flights</a>
        </div>
    @else
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-info">
                    <div class="booking-ref">
                        <i class="fa-regular fa-receipt"></i> {{ $booking->booking_reference }}
                    </div>
                    <div class="flight-route">
                        {{ $booking->outboundFlight->origin }} → {{ $booking->outboundFlight->destination }}
                        @if($booking->returnFlight)
                            (Round trip)
                        @else
                            (One way)
                        @endif
                    </div>
                    <div>
                        <span class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                        <span style="margin-left: 0.5rem; font-size: 0.8rem;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="price">
                    RM {{ number_format($booking->total_price, 2) }}
                </div>
                <div>
                    <a href="{{ route('booking.show', $booking) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    @endif

    <div style="margin-top: 2rem; text-align: center;">
        <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
    </div>
</div>
</body>
</html>