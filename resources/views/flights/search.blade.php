<!DOCTYPE html>
<html>
<head>
    <title>Flight Search</title>
</head>
<body>

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

    <label>From:</label><br>
    <input type="text" name="from" value="{{ old('from') }}"><br><br>

    <label>To:</label><br>
    <input type="text" name="to" value="{{ old('to') }}"><br><br>

    <label>Date:</label><br>
    <input type="date" name="departure_date" value="{{ old('departure_date') }}"><br><br>

    <label>Passengers:</label><br>
    <input type="number" name="passengers" min="1" value="{{ old('passengers') }}"><br><br>

    <label>Sort By:</label><br>
    <select name="sort">
        <option value="price">Price</option>
        <option value="departure_time">Time</option>
    </select><br><br>

    <button type="submit">Search</button>
</form>

</body>
</html>