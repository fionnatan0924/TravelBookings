@extends('app')

@section('content')
<div class="container" style="margin: 60px auto;">
    <h1 class="section-title" style="margin-bottom: 8px;">Hotels</h1>
    <p class="section-subtitle">Find the best hotels around the world</p>

    {{-- Search & Filter Form --}}
    <div style="background: white; border-radius: 20px; padding: 24px; margin-bottom: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <form method="GET" action="{{ route('hotels.index') }}" id="filter-form">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">Search by name</label>
                    <input type="text" name="search" placeholder="Hotel name" class="search-field" value="{{ request('search') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; margin-bottom: 6px;">Destination</label>
                    <select name="destination_id" class="search-select" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 12px;">
                        <option value="">All destinations</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; align-items: flex-end; gap: 12px;">
                    <button type="submit" class="button button-primary" style="width: 100%;">Search</button>
                    <a href="{{ route('hotels.index') }}" class="button button-secondary" style="width: 100%;">Clear</a>
                </div>
            </div>
        </form>
    </div>

    {{-- Hotels Grid --}}
    @if($hotels->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
        @foreach($hotels as $hotel)
        <a href="{{ route('hotels.show', $hotel->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card card-hover">
                <div class="card-image" style="background-image: url('{{ $hotel->image_url ?? 'https://via.placeholder.com/400x250?text=No+Image' }}'); min-height: 120px;"></div>
                <div class="card-content">
                    <h3 style="margin-bottom: 8px;">{{ $hotel->name }}</h3>
                    <p style="color: #666; font-size: 14px; margin-bottom: 12px;">{{ $hotel->location }}</p>
                    
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                        <span style="color: #f59e0b;">{{ number_format($hotel->rating, 1) }} ★</span>
                        <span style="color: #666; font-size: 13px;">({{ $hotel->reviews }} reviews)</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span style="font-size: 20px; font-weight: 700;">RM {{ number_format($hotel->price_per_night, 2) }}</span>
                        <span style="color: #666; font-size: 13px;">/night</span>
                    </div>

                    <button class="button button-primary" style="width: 100%; margin-top: 12px;">View details</button>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if($hotels->hasPages())
    <div style="margin-top: 40px;">
        {{ $hotels->links() }}
    </div>
    @endif
    @else
    <div style="text-align: center; padding: 60px; background: white; border-radius: 16px;">
        <p>No hotels found. Try adjusting your filters.</p>
        <a href="{{ route('hotels.index') }}" style="color: #111827; font-weight: 600;">Clear filters</a>
    </div>
    @endif
</div>
@endsection
