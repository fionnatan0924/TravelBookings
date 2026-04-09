<!DOCTYPE html>
<html>
<head>
    <title>Flight Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Search Flights</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('flights.results') }}" method="POST">
        @csrf
        <label>From:</label>
        <input type="text" name="from" placeholder="Departure City" required>

        <label>To:</label>
        <input type="text" name="to" placeholder="Arrival City" required>

        <label>Departure Date:</label>
        <input type="date" name="departure_date" required>

        <label>Passengers:</label>
        <input type="number" name="passengers" min="1" value="1" required>

        <button type="submit">Search Flights</button>
    </form>
</div>
</body>
</html>