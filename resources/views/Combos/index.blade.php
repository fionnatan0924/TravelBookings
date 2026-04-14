@extends('app')

@section('content')
<div class="container" style="margin: 60px auto;">
    <h1 style="font-size: 36px; font-weight: 500; margin-bottom: 32px;">Travel Combos</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px,1fr)); gap: 24px;">
        @foreach($packages as $pkg)
        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div style="height: 140px; background: url('{{ $pkg->image_url ?? 'https://via.placeholder.com/300x140?text=No+Image' }}') center/cover;"></div>
            <div style="padding: 20px;">
                <h3 style="margin-bottom: 8px;">{{ $pkg->name }}</h3>
                <p style="color: #666; font-size: 14px;">{{ $pkg->duration_days }} days · {{ $pkg->meal_plan }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
                    <span style="font-size: 20px; font-weight: 500;">RM {{ number_format($pkg->price) }}</span>
                    <a href="{{ route('combos.show', $pkg->id) }}" style="background: #1a1a1a; color: white; padding: 6px 20px; border-radius: 40px; text-decoration: none;">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection