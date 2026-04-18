<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation - Travelio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f3f6fc; padding: 2rem; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: white; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        h1 { color: #1e2f3e; margin-bottom: 1rem; }
        .ticket { background: #f8fafc; border-radius: 1rem; padding: 1.5rem; margin: 1.5rem 0; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; }
        .total { font-size: 1.4rem; font-weight: 800; color: #1f4b6e; margin-top: 1rem; }
        .btn { display: inline-block; background: #0f2b3d; color: white; border: none; padding: 0.8rem 2rem; border-radius: 40px; font-weight: 700; cursor: pointer; text-decoration: none; margin-top: 1rem; margin-right: 0.5rem; }
        .btn-secondary { background: #6c757d; }
        .btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1><i class="fa-regular fa-circle-check"></i> Booking Confirmed!</h1>
        <p>Your flight booking is confirmed. Reference: <strong>{{ $booking->booking_reference }}</strong></p>

        <div class="ticket">
            <div class="detail-row">
                <span>Flight:</span>
                <strong>{{ $booking->outboundFlight->airline ?? 'N/A' }}: {{ $booking->outboundFlight->origin }} → {{ $booking->outboundFlight->destination }}</strong>
            </div>
            <div class="detail-row">
                <span>Departure:</span>
                <span>{{ \Carbon\Carbon::parse($booking->outboundFlight->departure_date)->format('d M Y') }} at {{ \Carbon\Carbon::parse($booking->outboundFlight->departure_time)->format('H:i') }}</span>
            </div>
            @if($booking->returnFlight)
            <div class="detail-row">
                <span>Return:</span>
                <span>{{ \Carbon\Carbon::parse($booking->returnFlight->departure_date)->format('d M Y') }} at {{ \Carbon\Carbon::parse($booking->returnFlight->departure_time)->format('H:i') }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span>Passengers:</span>
                <span>{{ $booking->passengers->count() }} ({{ $booking->passengers->pluck('full_name')->implode(', ') }})</span>
            </div>
            <div class="detail-row">
                <span>Luggage:</span>
                <span>{{ $booking->luggage_option === 'yes' ? 'Added (+RM '.number_format($booking->luggage_cost,0).')' : 'Not added' }}</span>
            </div>
            <div class="total">
                Total Paid: RM {{ number_format($booking->total_price, 2) }}
            </div>
        </div>

        <p>A confirmation email has been sent to your registered address (demo).</p>
        <a href="{{ route('my-bookings') }}" class="btn">View My Bookings</a>
        <a href="{{ route('flights.index') }}" class="btn btn-secondary">Search Another Flight</a>
    </div>
</div>
</body>
</html>