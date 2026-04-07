<h2>Flight Search</h2>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/flights/search">
    @csrf

    <label>From:</label>
    <input type="text" name="from" required><br><br>

    <label>To:</label>
    <input type="text" name="to" required><br><br>

    <label>Date:</label>
    <input type="date" name="departure_date" required><br><br>

    <label>Passengers:</label>
    <input type="number" name="passengers" min="1" required><br><br>

    <button type="submit">Search</button>
</form>