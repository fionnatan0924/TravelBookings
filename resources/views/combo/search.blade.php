@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Flight + Hotel Combo</h2>
    <form method="POST" action="{{ route('combo.search') }}">
        @csrf
        <div class="row">
            <div class="col"><input type="text" name="origin" placeholder="From (city)" required></div>
            <div class="col"><input type="text" name="destination" placeholder="To (city)" required></div>
        </div>
        <div class="row">
            <div class="col"><input type="date" name="departure_date" required></div>
            <div class="col"><input type="date" name="check_in" required></div>
            <div class="col"><input type="date" name="check_out" required></div>
        </div>
        <div class="row">
            <div class="col"><input type="number" name="guests" min="1" value="1" required></div>
        </div>
        <button type="submit">Search Combos</button>
    </form>
</div>
@endsection