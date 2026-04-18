<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Luggage - Travelio</title>
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
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        h1 {
            font-size: 1.8rem;
            color: #1e2f3e;
            margin-bottom: 0.5rem;
        }
        .flight-summary {
            background: #f8fafc;
            border-radius: 1rem;
            padding: 1rem;
            margin: 1.5rem 0;
        }
        .option {
            margin: 1rem 0;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .option.selected {
            border-color: #2c6e9e;
            background: #eef6fc;
        }
        .option input {
            margin-right: 0.8rem;
            transform: scale(1.2);
        }
        .price {
            color: #1f4b6e;
            font-weight: 700;
            margin-top: 0.5rem;
        }
        button {
            background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
            margin-top: 1rem;
        }
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #6c7e94;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1><i class="fa-solid fa-suitcase"></i> Add extra luggage?</h1>
        <div class="flight-summary">
            <strong>{{ $flight->airline }}</strong> – {{ $flight->origin }} → {{ $flight->destination }}<br>
            {{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }} • {{ $flight->departure_time }}<br>
            Base price: RM {{ number_format($flight->price, 0) }} per adult
        </div>

        <form method="POST" action="{{ route('booking.process.luggage') }}">
            @csrf
            <div class="option" onclick="selectOption('no')">
                <label>
                    <input type="radio" name="add_luggage" value="no" required> No, I'll travel with cabin baggage only
                </label>
                <div class="price">Free</div>
            </div>
            <div class="option" onclick="selectOption('yes')">
                <label>
                    <input type="radio" name="add_luggage" value="yes"> Yes, add 20kg checked baggage (RM50 per adult)
                </label>
                <div class="price">+ RM50 per adult</div>
            </div>

            <button type="submit">Continue to passenger details →</button>
        </form>
        <a href="{{ route('flights.index') }}" class="back-link">← Back to search</a>
    </div>
</div>

<script>
    function selectOption(value) {
        document.querySelector(`input[name="add_luggage"][value="${value}"]`).checked = true;
        // highlight selected
        document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
        event.currentTarget.classList.add('selected');
    }
</script>
</body>
</html>