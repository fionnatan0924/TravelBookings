@extends('app')

@section('content')
<div class="container" style="margin: 60px auto;">
    <h1 class="section-title" style="margin-bottom: 8px;">Attractions</h1>
    <p class="section-subtitle">Discover amazing experiences around the world</p>

    {{-- Search & Filter Form --}}
    <div style="background: white; border-radius: 20px; padding: 24px; margin-bottom: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <form method="GET" action="{{ route('attractions.index') }}" id="filter-form">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px;">
                <div>
                    <label style="font-size: 13px; font-weight: 500;">Destination</label>
                    <select name="destination_id" class="filter-input" style="width:100%; padding: 10px; border:1px solid #ddd; border-radius: 8px;">
                        <option value="">All destinations</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-size: 13px; font-weight: 500;">Search by name</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g., Eiffel Tower" style="width:100%; padding: 10px; border:1px solid #ddd; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 13px; font-weight: 500;">Min Price (RM)</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" style="width:100%; padding: 10px; border:1px solid #ddd; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 13px; font-weight: 500;">Max Price (RM)</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="500" style="width:100%; padding: 10px; border:1px solid #ddd; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 13px; font-weight: 500;">Sort by</label>
                    <select name="sort" style="width:100%; padding: 10px; border:1px solid #ddd; border-radius: 8px;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Highest Rated</option>
                    </select>
                </div>
                <div style="display: flex; align-items: flex-end;">
                    <button type="submit" style="background: #1a1a1a; color: white; padding: 10px 20px; border: none; border-radius: 40px; width:100%;">Search →</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Attractions Grid --}}
    @if($attractions->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
        @foreach($attractions as $att)
        <a href="{{ route('attractions.show', $att->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card-hover" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="height: 120px; background: url('{{ $att->image_url ?? 'https://via.placeholder.com/400x250?text=No+Image' }}') center/cover;"></div>
                <div style="padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                        <span class="rating-star">★</span>
                        <span style="font-weight: 600;">{{ $att->rating }}</span>
                        <span style="color: #666; font-size: 13px;">/5 · {{ number_format($att->reviews) }} reviews</span>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 6px;">{{ $att->name }}</h3>
                    <p style="color: #666; font-size: 13px;">{{ $att->destination->name }}</p>
                    <div style="margin: 12px 0;">
                        @if($att->discount_text)
                            <span class="badge-discount">{{ $att->discount_text }}</span>
                        @endif
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <div>
                            @if($att->original_price && $att->original_price > $att->price)
                                <span style="text-decoration: line-through; color: #999; font-size: 13px;">RM {{ number_format($att->original_price, 2) }}</span>
                            @endif
                            <span style="font-size: 22px; font-weight: 600;">RM {{ number_format($att->price, 2) }}</span>
                        </div>
                        <div style="font-size: 12px; color: #ff6b6b;">{{ $att->booking_text ?? 'Book now' }}</div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div style="margin-top: 40px;">
        {{ $attractions->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 60px; background: white; border-radius: 16px;">
        <p>No attractions found. Try adjusting your filters.</p>
    </div>
    @endif
</div>
@endsection