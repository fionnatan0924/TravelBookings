@extends('layouts.app')

@section('title', 'Search Flights - Travelio')

@section('content')
<div class="flight-page-layout">
    <aside class="recent-sidebar">
        <div class="recent-card">
            <h4><i class="fa-regular fa-clock"></i> Recent searches</h4>
            @if(session()->has('flight_searches') && count(session('flight_searches')) > 0)
                <div class="recent-list">
                    @foreach(session('flight_searches') as $search)
                    <div class="recent-item">
                        <div class="recent-route">{{ $search['from'] }} → {{ $search['to'] }}</div>
                        <div class="recent-details">
                            {{ $search['departure_date'] }} • {{ ucfirst($search['class']) }} • {{ $search['adults'] }} adult(s)
                            <small>{{ $search['searched_at'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="no-recent">No recent searches yet.<br>Search for flights to see them here.</p>
            @endif
        </div>
    </aside>

    <div class="flight-card">
        <div class="card-header">
            <h2><i class="fa-solid fa-plane-departure"></i> Travelio</h2>
            <p>Smart search · best routes</p>
        </div>
        <div class="form-container">
            <form id="flightSearchForm" action="{{ route('flights.results') }}" method="POST" novalidate>
                @csrf

                <div class="trip-type-group">
                    <div class="trip-option">
                        <input type="radio" name="trip_type" id="trip_oneway" value="oneway" checked>
                        <label for="trip_oneway"><i class="fa-solid fa-arrow-right"></i> One Way</label>
                    </div>
                    <div class="trip-option">
                        <input type="radio" name="trip_type" id="trip_round" value="round">
                        <label for="trip_round"><i class="fa-solid fa-arrow-right-arrow-left"></i> Return</label>
                    </div>
                    <div class="trip-option">
                        <input type="radio" name="trip_type" id="trip_multi" value="multi">
                        <label for="trip_multi"><i class="fa-solid fa-layer-group"></i> Multi-city</label>
                    </div>
                </div>

                <div id="standardFields">
                    <div class="input-row">
                        <div class="field">
                            <label><i class="fa-solid fa-location-dot"></i> From</label>
                            <div class="input-icon">
                                <i class="fa-solid fa-city"></i>
                                <select name="from" id="originInput">
                                    <option value="">Select departure city</option>
                                    @foreach($destinations as $city => $code)
                                        <option value="{{ $code }}">{{ $city }} ({{ $code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="error-message" id="originError"></div>
                        </div>
                        <div class="field">
                            <label><i class="fa-solid fa-location-arrow"></i> To</label>
                            <div class="input-icon">
                                <i class="fa-solid fa-map-pin"></i>
                                <select name="to" id="destInput">
                                    <option value="">Select arrival city</option>
                                    @foreach($destinations as $city => $code)
                                        <option value="{{ $code }}">{{ $city }} ({{ $code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="error-message" id="destError"></div>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="field">
                            <label><i class="fa-regular fa-calendar"></i> Departure</label>
                            <div class="input-icon">
                                <i class="fa-regular fa-calendar-check"></i>
                                <input type="date" name="departure_date" id="departureDate">
                            </div>
                            <div class="error-message" id="departureError"></div>
                        </div>
                        <div class="field" id="returnDateContainer" style="display: none;">
                            <label><i class="fa-regular fa-calendar-plus"></i> Return</label>
                            <div class="input-icon">
                                <i class="fa-regular fa-calendar-alt"></i>
                                <input type="date" name="return_date" id="returnDate">
                            </div>
                            <div class="error-message" id="returnError"></div>
                        </div>
                    </div>
                </div>

                <div id="multiCityPanel" class="multi-city-panel hidden">
                    <div id="segmentsContainer"></div>
                    <button type="button" id="addSegmentBtn" class="add-segment-btn">
                        <i class="fa-solid fa-plus-circle"></i> Add another flight
                    </button>
                    <div id="multiCityGlobalError" class="error-message"></div>
                </div>

                <hr>

                <div class="input-row">
                    <div class="field">
                        <label><i class="fa-solid fa-crown"></i> Cabin class</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-chair"></i>
                            <select name="class" id="cabinClass">
                                <option value="economy">Economy</option>
                                <option value="premium">Premium Economy</option>
                                <option value="business">Business</option>
                                <option value="first">First Class</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label><i class="fa-solid fa-users"></i> Passengers</label>
                    <div class="passenger-grid">
                        <div class="field">
                            <div class="passenger-label">Adults <span>(12+ yrs)</span></div>
                            <div class="input-icon">
                                <i class="fa-solid fa-user"></i>
                                <input type="number" name="adults" id="adults" min="1" max="9" value="1">
                            </div>
                            <div class="error-message" id="adultsError"></div>
                        </div>
                        <div class="field">
                            <div class="passenger-label">Children <span>(2-11 yrs)</span></div>
                            <div class="input-icon">
                                <i class="fa-solid fa-child"></i>
                                <input type="number" name="children" id="children" min="0" max="6" value="0">
                            </div>
                        </div>
                        <div class="field">
                            <div class="passenger-label">Infants <span>(under 2 yrs)</span></div>
                            <div class="input-icon">
                                <i class="fa-solid fa-baby"></i>
                                <input type="number" name="infants" id="infants" min="0" max="4" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="primary-btn">
                    <i class="fa-solid fa-magnifying-glass"></i> Search Flights
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Layout: two columns */
    .flight-page-layout {
        display: flex;
        gap: 2rem;
        max-width: 1280px;
        margin: 0 auto;
        align-items: flex-start;
    }

    .recent-sidebar {
        flex: 0 0 280px;
        position: sticky;
        top: 100px;
    }
    .recent-card {
        background: white;
        border-radius: 1.5rem;
        padding: 1.2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
    }
    .recent-card h4 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1f3b4c;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .recent-list {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }
    .recent-item {
        background: #f8fafd;
        border-radius: 1rem;
        padding: 0.6rem 1rem;
        transition: 0.2s;
    }
    .recent-item:hover {
        background: #eef2fa;
    }
    .recent-route {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1f4b6e;
    }
    .recent-details {
        font-size: 0.75rem;
        color: #5b7e9c;
        margin-top: 4px;
    }
    .recent-details small {
        display: block;
        font-size: 0.7rem;
        margin-top: 2px;
        color: #8aa0b5;
    }
    .no-recent {
        font-size: 0.8rem;
        color: #6c7e94;
        text-align: center;
        padding: 1rem 0;
    }

    /* Right column – flight card */
    .flight-card {
        flex: 1;
        background: #ffffff;
        border-radius: 2rem;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .card-header {
        background: #ffffff;
        padding: 1.8rem 2rem 1rem 2rem;
        border-bottom: 1px solid #eff3f8;
    }
    .card-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1f3b4c, #2c6e9e);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .card-header p {
        font-size: 0.85rem;
        color: #5b7e9c;
        margin-top: 6px;
    }
    .form-container {
        padding: 2rem;
    }

    /* Trip type buttons */
    .trip-type-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
        background: #f8fafd;
        padding: 0.4rem;
        border-radius: 60px;
        width: fit-content;
    }
    .trip-option {
        position: relative;
    }
    .trip-option input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .trip-option label {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 40px;
        background: transparent;
        color: #4f6f8f;
        cursor: pointer;
        transition: all 0.2s;
    }
    .trip-option input:checked + label {
        background: #ffffff;
        color: #1f4b6e;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        font-weight: 700;
    }

    /* Input rows */
    .input-group {
        margin-bottom: 1.5rem;
    }
    .input-row {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
        margin-bottom: 1.2rem;
    }
    .input-row .field {
        flex: 1;
        min-width: 160px;
    }
    label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #5b7e9c;
        display: block;
        margin-bottom: 0.4rem;
    }
    .input-icon {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-icon i {
        position: absolute;
        left: 14px;
        color: #9bb1c7;
        font-size: 1rem;
        pointer-events: none;
    }
    input, select {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.5rem;
        font-size: 0.95rem;
        font-family: 'Inter', monospace;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #ffffff;
        transition: all 0.2s;
        outline: none;
        color: #1e2f3e;
        font-weight: 500;
    }
    select {
        padding-left: 2.5rem;
        appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23647b92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
        background-repeat: no-repeat;
        background-position: right 1rem center;
    }
    input:focus, select:focus {
        border-color: #2c6e9e;
        box-shadow: 0 0 0 3px rgba(44, 110, 158, 0.08);
    }
    input.error-field, select.error-field {
        border-color: #e53e3e;
        background-color: #fff9f9;
    }
    .error-message {
        font-size: 0.7rem;
        color: #e53e3e;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Passenger grid */
    .passenger-grid {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }
    .passenger-grid .field {
        flex: 1;
    }
    .passenger-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #2c5a7a;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .passenger-label span {
        font-weight: normal;
        color: #6c8eae;
        font-size: 0.7rem;
    }

    /* Multi-city panel */
    .multi-city-panel {
        background: #ffffff;
        border-radius: 1.2rem;
        padding: 0.2rem 0 0.5rem 0;
        margin-top: 0.5rem;
    }
    .segment-card {
        background: #fafcff;
        border: 1px solid #ecf3fa;
        border-radius: 1.2rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .segment-card.error-segment {
        border-color: #e53e3e;
        background-color: #fff5f5;
    }
    .segment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #2c6e9e;
    }
    .segment-remove {
        background: none;
        border: none;
        color: #b91c1c;
        cursor: pointer;
        font-size: 1rem;
        padding: 4px 8px;
        border-radius: 30px;
    }
    .segment-remove:hover {
        background: #fee2e2;
    }
    .add-segment-btn {
        background: transparent;
        border: 1.5px dashed #cbdbe0;
        padding: 0.7rem;
        width: 100%;
        border-radius: 60px;
        font-weight: 600;
        color: #2c6e9e;
        cursor: pointer;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: 0.2s;
    }
    .add-segment-btn:hover {
        background: #f0f7ff;
        border-color: #2c6e9e;
    }

    /* Search button */
    button.primary-btn {
        width: 100%;
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        border: none;
        padding: 1rem;
        border-radius: 40px;
        font-size: 1rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
    }
    button.primary-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(105deg, #1a3a52, #28638b);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    hr {
        margin: 1rem 0;
        border: 0;
        height: 1px;
        background: #ecf3fa;
    }
    .hidden {
        display: none;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .flight-page-layout {
            flex-direction: column;
        }
        .recent-sidebar {
            flex: auto;
            position: static;
            margin-bottom: 1rem;
        }
    }
    @media (max-width: 680px) {
        .form-container {
            padding: 1.5rem;
        }
        .input-row {
            flex-direction: column;
            gap: 1rem;
        }
        .passenger-grid {
            flex-direction: column;
        }
    }
</style>

<script src="{{ asset('js/flight-search.js') }}" defer></script>
@endsection