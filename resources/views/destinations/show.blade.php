@extends('layouts.app')

@section('content')
<div class="container" style="margin: 60px auto;">
    {{-- Hero Image --}}
    <div style="background: url('{{ $destination->image_url ?? 'https://via.placeholder.com/1200x400?text=No+Image' }}') center/cover; height: 300px; border-radius: 20px; margin-bottom: 40px;"></div>
    
    <h1 style="font-size: 48px; margin-bottom: 12px;">{{ $destination->name }}</h1>
    <p style="font-size: 18px; margin-bottom: 24px;">Starting from RM {{ number_format($destination->starting_price) }}</p>

    <h2 style="font-size: 28px; font-weight: 500; margin-bottom: 24px;">Combos in {{ $destination->name }}</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px,1fr)); gap: 24px;">
        @forelse($destination->packages as $pkg)
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div style="height: 140px; background: #eaeaea; display: flex; align-items: center; justify-content: center; font-size: 48px;">{{ $pkg->emoji ?? '✈️' }}</div>
            <div style="padding: 20px;">
                <h3>{{ $pkg->name }}</h3>
                <p style="color: #666; font-size: 14px; margin: 8px 0;">{{ $pkg->duration_days }} days · {{ $pkg->meal_plan }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
                    <span style="font-size: 20px; font-weight: 500;">RM {{ number_format($pkg->price) }}</span>
                    <a href="{{ route('combos.show', $pkg->id) }}" style="background: #1a1a1a; color: white; padding: 8px 20px; border-radius: 40px; text-decoration: none;">View</a>
                </div>
            </div>
        </div>
        @empty
            <p>No combos available for this destination yet.</p>
        @endforelse
    </div>
</div>
@endsection