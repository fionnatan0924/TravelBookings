@extends('layouts.app')

@section('title', 'Flight + Hotel Combo')

@section('content')
@if($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="combo-container">
    <div class="combo-card">
        <div class="card-header">
            <h2><i class="fa-solid fa-umbrella-beach"></i> Flight + Hotel Combo</h2>
            <p>Save more when you book your flight and hotel together</p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('combo.search') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-plane-departure"></i> From</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-city"></i>
                            <select name="origin" required>
                                <option value="">Select departure city</option>
                                @foreach($airportOptions as $code => $label)
                                    <option value="{{ $code }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa-solid fa-plane-arrival"></i> To</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-location-dot"></i>
                            <select name="destination" required>
                                <option value="">Select arrival city</option>
                                @foreach($airportOptions as $code => $label)
                                    <option value="{{ $code }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-regular fa-calendar"></i> Departure Date</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-calendar-check"></i>
                            <input type="date" name="departure_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa-regular fa-calendar-plus"></i> Hotel Check-in</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-calendar-alt"></i>
                            <input type="date" name="check_in" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa-regular fa-calendar-minus"></i> Hotel Check-out</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" name="check_out" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-users"></i> Guests</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-user-group"></i>
                            <input type="number" name="guests" min="1" max="10" value="1" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i> Search Combos
                </button>
            </form>
        </div>
    </div>

    <div class="info-box">
        <i class="fa-solid fa-circle-info"></i> Combo packages include flight + hotel stay. Best price guaranteed.
    </div>
</div>

<style>
    .combo-container { max-width: 900px; margin: 2rem auto 2rem auto; }
    .combo-card { background: white; border-radius: 1.5rem; box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem; }
    .card-header { background: linear-gradient(135deg, #0f2b3d, #1f4b6e); padding: 1.5rem 2rem; color: white; }
    .card-header h2 { font-size: 1.8rem; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 10px; }
    .card-header p { opacity: 0.9; font-size: 0.9rem; }
    .card-body { padding: 2rem; }
    .form-row { display: flex; gap: 1.2rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .form-group { flex: 1; min-width: 160px; }
    label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #4b6b8f; display: block; margin-bottom: 0.4rem; }
    .input-icon { position: relative; }
    .input-icon i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #8aa0b5; font-size: 0.9rem; pointer-events: none; z-index: 1; }
    input, select { width: 100%; padding: 0.8rem 1rem 0.8rem 2.4rem; font-size: 0.95rem; border: 1.5px solid #e2e8f0; border-radius: 14px; background: #ffffff; transition: all 0.2s; font-family: 'Inter', sans-serif; appearance: none; }
    select { background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23647b92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>'); background-repeat: no-repeat; background-position: right 1rem center; }
    input:focus, select:focus { border-color: #2c6e9e; box-shadow: 0 0 0 3px rgba(44,110,158,0.1); outline: none; }
    .search-btn { width: 100%; background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; border: none; padding: 1rem; border-radius: 40px; font-weight: 700; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 1rem; transition: transform 0.2s, box-shadow 0.2s; }
    .search-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .info-box { background: #eef2fa; border-radius: 1rem; padding: 1rem; text-align: center; font-size: 0.85rem; color: #2c5a7a; display: flex; align-items: center; justify-content: center; gap: 8px; }
    @media (max-width: 680px) { .card-body { padding: 1.5rem; } .form-row { flex-direction: column; gap: 1rem; } }
</style>
@endsection