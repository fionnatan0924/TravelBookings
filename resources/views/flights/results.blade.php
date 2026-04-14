@extends('app')

@section('content')
<div class="container" style="max-width: 1000px; margin: 60px auto;">
    <h2 style="font-size: 24px; font-weight: 500; margin-bottom: 24px;">Available flights</h2>

    @if($flights->isEmpty())
        <div style="background: white; border-radius: 16px; padding: 48px; text-align: center;">
            <p>No flights found for your search.</p>
            <a href="{{ url('/flights') }}" style="color: #1a1a1a;">← New search</a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 16px;">
            @foreach($flights as $flight)
            <div style="background: white; border-radius: 16px; padding: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="min-width: 160px;">
                    <div style="font-size: 12px; color: #888;">From → To</div>
                    <div style="font-weight: 500;">{{ $flight->from }} → {{ $flight->to }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #888;">Departure</div>
                    <div>{{ $flight->departure_date }} at {{ $flight->departure_time }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #888;">Seats left</div>
                    <div>{{ $flight->available_seats }}</div>
                </div>
                <div>
                    <div style="font-size: 20px; font-weight: 500;">RM {{ number_format($flight->price, 2) }}</div>
                    <button style="background: #1a1a1a; color: white; border: none; padding: 6px 20px; border-radius: 40px; margin-top: 6px; cursor: pointer;">Select</button>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top: 32px;">
            {{ $flights->links() }}
        </div>
    @endif
</div>
@endsection