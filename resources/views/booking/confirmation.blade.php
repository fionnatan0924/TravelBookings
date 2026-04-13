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
        button { background: #2c6e9e; color: white; border: none; padding: 0.8rem 2rem; border-radius: 40px; font-weight: 700; cursor: pointer; margin-top: 1rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1><i class="fa-regular fa-circle-check"></i> Booking Confirmation</h1>
        <p>Thank you! Your flight has been reserved.</p>

        <div class="ticket">
            <div class="detail-row">
                <span>Flight:</span>
                <strong>{{ $flight->airline }} {{ $flight->origin }} → {{ $flight->destination }}</strong>
            </div>
            <div class="detail-row">
                <span>Date & Time:</span>
                <span>{{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }} • {{ $flight->departure_time }}</span>
            </div>
            <div class="detail-row">
                <span>Passengers:</span>
                <span>{{ $booking['passengers'] ? count($booking['passengers']) : 0 }} adult(s)</span>
            </div>
            <div class="detail-row">
                <span>Checked Baggage:</span>
                <span>{{ $booking['luggage'] === 'yes' ? 'Yes (+RM '.number_format($luggageCost,0).')' : 'No' }}</span>
            </div>
            <div class="total">
                Total Paid: RM {{ number_format($totalPrice, 2) }}
            </div>
        </div>

        <p>We've sent a confirmation email to your registered address (demo).</p>
        <button onclick="window.location.href='/home'">Back to Home</button>
    </div>
</div>
</body>
</html>