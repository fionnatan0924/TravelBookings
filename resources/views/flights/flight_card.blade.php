<div class="flight-card">
    {{-- Airline & baggage --}}
    <div class="airline-section">
        <div class="airline-name">
            <i class="fa-solid fa-plane-circle-check"></i> {{ $flight->airline ?? 'Airline' }}
        </div>
        @if(isset($flight->baggage))
            <div class="baggage"><i class="fa-solid fa-suitcase"></i> {{ $flight->baggage }}</div>
        @else
            <div class="baggage"><i class="fa-solid fa-suitcase"></i> Checked baggage 23 kg</div>
        @endif
    </div>

    {{-- Flight times, terminals, duration --}}
    <div class="flight-times">
        <div class="time-block">
            <div class="time">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
            <div class="terminal">{{ $flight->origin }} {{ $flight->origin_terminal ?? 'T1' }}</div>
        </div>
        <div class="arrow"><i class="fa-solid fa-arrow-right-long"></i></div>
        <div class="time-block">
            <div class="time">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</div>
            <div class="terminal">{{ $flight->destination }} {{ $flight->destination_terminal ?? 'T2' }}</div>
        </div>
        <div class="duration-info">
            <div class="duration"><i class="fa-regular fa-clock"></i> {{ $flight->duration ?? '4h 25m' }}</div>
            <div class="direct-badge"><i class="fa-solid fa-circle-check"></i> Direct</div>
        </div>
    </div>

    {{-- Price and selection --}}
    <div class="price-section">
        <div class="price">RM {{ number_format($flight->price, 0) }}</div>
        @if($type === 'return')
            <span class="return-label">Return</span>
        @endif
        <form action="{{ route('booking.select') }}" method="POST">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
            <input type="hidden" name="trip_type" value="{{ $tripType }}">
            <input type="hidden" name="flight_type" value="{{ $type }}">
            <button type="submit" class="select-btn">Select</button>
        </form>
        @if(($flight->seats_left ?? 0) < 10 && ($flight->seats_left ?? 0) > 0)
            <div class="stock-warning"><i class="fa-solid fa-exclamation-circle"></i> &lt;9 left</div>
        @endif
    </div>
</div>