<!DOCTYPE html>
<html>
<head>
    <title>Flight Results</title>
</head>
<body>

<h2>Available Flights</h2>

@if($flights->isEmpty())
    <p>No flights found.</p>
@else
    <table border="1" cellpadding="10">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price (RM)</th>
            <th>Seats</th>
        </tr>

        @foreach($flights as $flight)
        <tr>
            <td>{{ $flight->from }}</td>
            <td>{{ $flight->to }}</td>
            <td>{{ $flight->departure_date }}</td>
            <td>{{ $flight->departure_time }}</td>
            <td>{{ $flight->price }}</td>
            <td>{{ $flight->available_seats }}</td>
        </tr>
        @endforeach
    </table>

    <br>

    <!-- ✅ Pagination -->
    {{ $flights->links() }}
@endif

<br><br>
<a href="/flights">Back to Search</a>

</body>
</html>