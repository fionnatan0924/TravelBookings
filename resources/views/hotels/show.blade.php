@extends('app')

@section('content')
<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    <a href="{{ route('hotels.index') }}" style="color: #111827; font-weight: 600; text-decoration: none; margin-bottom: 24px; display: inline-block;">← Back to hotels</a>

    <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="height: 400px; background: url('{{ $hotel->image_url ?? 'https://via.placeholder.com/1200x400?text=No+Image' }}') center/cover;"></div>

        <div style="padding: 40px;">
            <h1 style="margin: 0 0 12px; font-size: 36px; font-weight: 600;">{{ $hotel->name }}</h1>
            
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
                <span style="color: #f59e0b; font-size: 18px;">{{ number_format($hotel->rating, 1) }} ★</span>
                <span style="color: #666;">({{ $hotel->reviews }} reviews)</span>
                <span style="color: #666;">{{ $hotel->location }}</span>
            </div>

            @if($hotel->description)
            <div style="color: #374151; line-height: 1.6; margin-bottom: 32px;">
                {{ $hotel->description }}
            </div>
            @endif

            <div style="background: #f8fafc; border-radius: 12px; padding: 24px; margin-bottom: 32px;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 8px;">Price per night</div>
                        <div style="font-size: 28px; font-weight: 700;">RM {{ number_format($hotel->price_per_night, 2) }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #999; margin-bottom: 8px;">Location</div>
                        <div style="font-size: 18px; font-weight: 600;">{{ $hotel->location }}</div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <button style="background: #111827; color: white; border: none; padding: 14px 40px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;">Book now</button>
                <a href="{{ route('hotels.index') }}" style="background: #f8fafc; color: #111827; border: 1px solid #ddd; padding: 14px 40px; border-radius: 8px; font-size: 16px; font-weight: 600; text-decoration: none; cursor: pointer;">← Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
