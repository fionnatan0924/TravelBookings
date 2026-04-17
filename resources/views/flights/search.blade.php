@extends('app')

@section('content')
<div class="container" style="max-width: 800px; margin: 60px auto;">
    <h1 style="font-size: 32px; font-weight: 500; margin-bottom: 8px;">Search flights</h1>
    <p style="color: #666; margin-bottom: 32px;">Find the best rates for your next trip.</p>

    @if ($errors->any())
        <div style="background: #fef2f2; border-left: 3px solid #dc2626; padding: 16px; margin-bottom: 24px;">
            @foreach ($errors->all() as $error)
                <p style="color: #991b1b;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('flights.search') }}" style="background: white; padding: 32px; border-radius: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.05);">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">From</label>
                    <select name="from" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                        <option value="">Select departure city</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->name }}" {{ old('from') == $dest->name ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">To</label>
                    <input type="text" name="to" value="{{ old('to', request('to')) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">Departure date</label>
                    <input type="date" name="departure_date" value="{{ old('departure_date') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">Passengers</label>
                    <input type="number" name="passengers" min="1" value="{{ old('passengers',1) }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                </div>
            </div>
            <div>
                <label style="display: block; font-size: 13px; margin-bottom: 6px;">Sort by</label>
                <select name="sort" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                    <option value="price">Price (lowest first)</option>
                    <option value="departure_time">Departure time</option>
                </select>
            </div>
            <button type="submit" style="background: #1a1a1a; color: white; padding: 14px; border: none; border-radius: 40px; font-weight: 500; cursor: pointer;">Search flights</button>
        </div>
    </form>
</div>
@endsection