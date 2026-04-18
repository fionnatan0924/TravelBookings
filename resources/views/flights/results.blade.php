<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Results - Travelio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f6fc;
            padding: 2rem;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Search summary bar */
        .search-summary {
            background: white;
            border-radius: 1.2rem;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .route-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e2f3e;
        }
        .flight-count {
            color: #2c6e9e;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        /* Sorting tabs */
        .sorting-tabs {
            display: flex;
            gap: 0.8rem;
            margin: 1.5rem 0 1.2rem 0;
            flex-wrap: wrap;
        }
        .sort-btn {
            background: white;
            border: 1px solid #dce5ef;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #4a627a;
            cursor: pointer;
            transition: 0.2s;
        }
        .sort-btn.active {
            background: #0f2b3d;
            color: white;
            border-color: #0f2b3d;
        }
        .sort-btn:hover {
            background: #eef2fa;
        }

        /* Flight card */
        .flight-card {
            background: white;
            border-radius: 1rem;
            margin-bottom: 1rem;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            transition: 0.2s;
            border: 1px solid #eef2f8;
        }
        .flight-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        /* Airline + baggage */
        .airline-section {
            width: 160px;
        }
        .airline-name {
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .baggage {
            font-size: 0.7rem;
            color: #2c7a4d;
            background: #e6f4ea;
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            margin-top: 6px;
        }

        /* Flight times */
        .flight-times {
            flex: 2;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .time-block {
            text-align: center;
        }
        .time {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a2f3f;
        }
        .terminal {
            font-size: 0.7rem;
            color: #6c7e94;
        }
        .arrow {
            color: #8aa0b5;
            font-size: 1.2rem;
        }
        .duration {
            font-size: 0.85rem;
            background: #f0f4fa;
            padding: 0.2rem 0.8rem;
            border-radius: 30px;
            white-space: nowrap;
        }
        .direct-badge {
            font-size: 0.7rem;
            color: #2c6e9e;
            font-weight: 600;
        }

        /* Price & select */
        .price-section {
            text-align: right;
            min-width: 140px;
        }
        .price {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1f4b6e;
        }
        .return-label {
            font-size: 0.7rem;
            color: #6c7e94;
            display: block;
        }
        .select-btn {
            background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            cursor: pointer;
            width: 100%;
        }
        .select-btn:hover {
            background: #0f3b55;
        }
        .stock-warning {
            font-size: 0.7rem;
            color: #e67e22;
            margin-top: 5px;
        }

        hr {
            margin: 1rem 0;
        }
        .no-flights {
            background: #fff3e0;
            padding: 2rem;
            text-align: center;
            border-radius: 1rem;
        }

        @media (max-width: 800px) {
            .flight-card { flex-direction: column; align-items: stretch; gap: 1rem; }
            .price-section { text-align: left; }
            .select-btn { width: auto; }
        }
    </style>
</head>
<body>
<div class="search-summary">
    <div class="route-title">
        @if($tripType === 'multi')
            Multi-city trip
        @else
            {{ $searchParams['origin'] }} → {{ $searchParams['destination'] }}
        @endif
        <span class="flight-count">
            @if($tripType === 'multi')
                {{ collect($results)->sum(fn($r) => count($r['flights'])) }} flights found
            @else
                {{ count($outboundFlights) }} flights found
            @endif
        </span>
    </div>
    <div style="font-size:0.85rem; color:#5b7e9c; margin-top: 6px;">
        @if($tripType !== 'multi')
            {{ $searchParams['departure_date'] }} • {{ ucfirst($searchParams['class']) }} • 
            {{ $searchParams['adults'] }} Adult(s)
        @else
            {{ ucfirst($searchParams['class']) }} • {{ $searchParams['adults'] }} Adult(s)
        @endif
    </div>
</div>

    {{-- FLIGHT LISTINGS --}}
    @if($tripType === 'multi')
        @foreach($results as $idx => $result)
            <div style="margin: 1.5rem 0 0.5rem 0; font-weight: 700;">
                <i class="fa-solid fa-map-pin"></i> Segment {{ $idx+1 }}: {{ $result['segment']['from'] }} → {{ $result['segment']['to'] }}
            </div>
            @forelse($result['flights'] as $flight)
                @include('flights._flight_card', ['flight' => $flight, 'type' => 'outbound'])
            @empty
                <div class="no-flights">No flights for this segment</div>
            @endforelse
        @endforeach
    @else
        {{-- Outbound flights --}}
        @forelse($outboundFlights as $flight)
            @include('flights._flight_card', ['flight' => $flight, 'type' => 'outbound'])
        @empty
            <div class="no-flights">No outbound flights found. Try different dates.</div>
        @endforelse

        {{-- Return flights (round trip) --}}
        @if($tripType === 'round')
            <div style="margin: 2rem 0 1rem 0; font-size: 1.2rem; font-weight: 700;">
                <i class="fa-solid fa-arrow-left"></i> Return flights
            </div>
            @forelse($returnFlights as $flight)
                @include('flights._flight_card', ['flight' => $flight, 'type' => 'return'])
            @empty
                <div class="no-flights">No return flights found</div>
            @endforelse
        @endif
    @endif

    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ url('/') }}" style="background: #6c757d; color: white; padding: 0.6rem 1.8rem; border-radius: 40px; text-decoration: none; display: inline-block;">New search</a>
    </div>
</div>

<script>
    // Simple sorting demo – you can replace with full logic
    document.querySelectorAll('.sort-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // Here you would re-sort the flight cards
            alert('Sorting by ' + this.innerText + ' – implement your sorting logic');
        });
    });
</script>
</body>
</html>