@extends('app')

@section('content')
<div style="max-width:1000px; margin:40px auto; padding:0 20px;">
    <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08);">
        <div style="background:#e0f4f5; padding:60px; text-align:center;">
            <div style="font-size:80px;">{{ $combo->emoji ?? '✈️' }}</div>
        </div>
        <div style="padding:32px;">
            <span style="display:inline-block; background:#187B83; color:#fff; padding:4px 12px; border-radius:20px; font-size:12px; margin-bottom:16px;">
                {{ ucfirst($combo->type) }}
            </span>
            <h1 style="margin:0 0 12px; color:#333;">{{ $combo->name }}</h1>
            <p style="color:#666; margin-bottom:24px;">
                Destination: <strong>{{ $combo->destination->name ?? 'Various' }}</strong>
            </p>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; padding:20px 0; border-top:1px solid #eee; border-bottom:1px solid #eee; margin-bottom:24px;">
                <div>
                    <div style="font-size:12px; color:#999;">Duration</div>
                    <div style="font-size:18px; font-weight:500;">{{ $combo->duration_days }} Days / {{ $combo->duration_nights }} Nights</div>
                </div>
                <div>
                    <div style="font-size:12px; color:#999;">Meal Plan</div>
                    <div style="font-size:18px; font-weight:500;">{{ $combo->meal_plan }}</div>
                </div>
                <div>
                    <div style="font-size:12px; color:#999;">Price</div>
                    <div style="font-size:24px; font-weight:500; color:#187B83;">RM {{ number_format($combo->price) }}</div>
                </div>
            </div>

            <div style="text-align:center;">
                <button style="background:#187B83; color:#fff; border:none; padding:14px 40px; border-radius:8px; font-size:16px; cursor:pointer;">Book This Combo</button>
                <br><br>
                <a href="{{ route('combos.index') }}" style="color:#187B83;">← Back to all combos</a>
            </div>
        </div>
    </div>
</div>
@endsection