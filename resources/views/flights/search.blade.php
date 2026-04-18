<form method="POST" action="{{ route('flights.results') }}">
    @csrf
    <input type="hidden" name="trip_type" value="oneway">
    <input type="hidden" name="class" value="economy">
    <input type="hidden" name="adults" value="{{ old('passengers', 1) }}">
    <input type="hidden" name="children" value="0">
    <input type="hidden" name="infants" value="0">

    <!-- your visible fields -->
    <label>From:</label>
    <input type="text" name="from" value="{{ old('from') }}">

    <label>To:</label>
    <input type="text" name="to" value="{{ old('to') }}">

    <label>Date:</label>
    <input type="date" name="departure_date" value="{{ old('departure_date') }}">

    <!-- Passengers number will be used as adults -->
    <label>Passengers:</label>
    <input type="number" name="passengers" min="1" value="{{ old('passengers', 1) }}">

    <label>Sort By:</label>
    <select name="sort">
        <option value="price" {{ old('sort') == 'price' ? 'selected' : '' }}>Price</option>
        <option value="departure_time" {{ old('sort') == 'departure_time' ? 'selected' : '' }}>Time</option>
    </select>

    <button type="submit">Search</button>
</form>