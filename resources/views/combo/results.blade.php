@extends('layouts.app')

@section('title', 'Select Your Combo')

@section('content')
<div class="combo-results">
    <div class="header">
        <h1><i class="fa-solid fa-umbrella-beach"></i> Choose Your Flight & Hotel</h1>
        <p>Select one flight and one hotel to book your combo package</p>
    </div>

    <form method="POST" action="{{ route('combo.book') }}" id="comboForm">
        @csrf
        <input type="hidden" name="flight_id" id="selected_flight_id">
        <input type="hidden" name="hotel_id" id="selected_hotel_id">

        <div class="section">
            <h2><i class="fa-solid fa-plane-departure"></i> Flights</h2>
            <div class="cards">
                @foreach($flights as $flight)
                <div class="card flight-card" data-id="{{ $flight->id }}">
                    <div class="card-header">
                        <span class="airline">{{ $flight->airline }}</span>
                        <span class="badge">{{ ucfirst($flight->cabin_class) }}</span>
                    </div>
                    <div class="card-body">
                        <div class="route">{{ $flight->origin }} → {{ $flight->destination }}</div>
                        <div class="date">{{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }}</div>
                        <div class="time">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                        <div class="price">RM {{ number_format($flight->price, 2) }}</div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="select-flight">Select Flight</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="section">
            <h2><i class="fa-solid fa-hotel"></i> Hotels</h2>
            <div class="cards">
                @foreach($hotels as $hotel)
                <div class="card hotel-card" data-id="{{ $hotel->id }}">
                    @if($hotel->image)
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="hotel-image">
                    @endif
                    <div class="card-header">
                        <span class="hotel-name">{{ $hotel->name }}</span>
                        <span class="stars">{!! str_repeat('★', $hotel->stars) !!}</span>
                    </div>
                    <div class="card-body">
                        <div class="city">{{ $hotel->city }}</div>
                        <div class="address">{{ $hotel->address }}</div>
                        <div class="price">RM {{ number_format($hotel->price_per_night, 2) }} / night</div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="select-hotel">Select Hotel</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="action">
            <button type="submit" id="bookBtn" disabled>Book Selected Combo</button>
        </div>
    </form>
</div>

<style>
    .combo-results { max-width: 1200px; margin: 0 auto; }
    .header { text-align: center; margin-bottom: 2rem; }
    .section { margin-bottom: 2rem; }
    .cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    .card { background: white; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: 0.2s; cursor: pointer; border: 2px solid transparent; }
    .card.selected { border-color: #1f4b6e; box-shadow: 0 4px 12px rgba(31,75,110,0.2); }
    .card-header { padding: 1rem; border-bottom: 1px solid #eef2f8; display: flex; justify-content: space-between; }
    .airline, .hotel-name { font-weight: bold; }
    .badge, .stars { background: #f0f4fa; padding: 0.2rem 0.5rem; border-radius: 20px; font-size: 0.8rem; }
    .card-body { padding: 1rem; }
    .route, .city { font-weight: 600; margin-bottom: 0.5rem; }
    .date, .time, .address { font-size: 0.85rem; color: #6c7e94; margin-bottom: 0.3rem; }
    .price { font-size: 1.2rem; font-weight: bold; color: #1f4b6e; margin-top: 0.5rem; }
    .card-footer { padding: 0.75rem; border-top: 1px solid #eef2f8; }
    button { width: 100%; background: #f0f4fa; border: none; padding: 0.5rem; border-radius: 30px; font-weight: 600; cursor: pointer; }
    .action { text-align: center; margin-top: 2rem; }
    #bookBtn { width: auto; background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; padding: 0.8rem 2rem; opacity: 0.6; }
    #bookBtn:enabled { opacity: 1; cursor: pointer; }
    /* Hotel image style */
    .hotel-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }
</style>

<script>
    let selectedFlight = null, selectedHotel = null;
    document.querySelectorAll('.flight-card').forEach(card => {
        const btn = card.querySelector('.select-flight');
        const select = () => {
            document.querySelectorAll('.flight-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            selectedFlight = card.dataset.id;
            document.getElementById('selected_flight_id').value = selectedFlight;
            toggleBookButton();
        };
        card.addEventListener('click', (e) => { if(e.target !== btn) select(); });
        btn.addEventListener('click', (e) => { e.stopPropagation(); select(); });
    });
    document.querySelectorAll('.hotel-card').forEach(card => {
        const btn = card.querySelector('.select-hotel');
        const select = () => {
            document.querySelectorAll('.hotel-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            selectedHotel = card.dataset.id;
            document.getElementById('selected_hotel_id').value = selectedHotel;
            toggleBookButton();
        };
        card.addEventListener('click', (e) => { if(e.target !== btn) select(); });
        btn.addEventListener('click', (e) => { e.stopPropagation(); select(); });
    });
    function toggleBookButton() {
        const btn = document.getElementById('bookBtn');
        if(selectedFlight && selectedHotel) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }
</script>
@endsection