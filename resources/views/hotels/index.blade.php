@extends('layouts.app')

@section('title', 'Hotels')

@section('content')
<div class="hotels-page">
    <div class="hero-section">
        <h1><i class="fa-solid fa-hotel"></i> Our Hotels</h1>
        <p>Discover exceptional stays, from boutique gems to luxury resorts</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <form method="GET" action="{{ route('hotels.index') }}" class="filter-form">
            <div class="filter-group">
                <i class="fa-solid fa-location-dot"></i>
                <select name="city">
                    <option value="">All destinations</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-filter">
                <i class="fa-solid fa-magnifying-glass"></i> Filter
            </button>
            @if(request('city'))
                <a href="{{ route('hotels.index') }}" class="btn-clear">Clear</a>
            @endif
        </form>
    </div>

    <!-- Hotels Grid -->
    <div class="hotels-grid">
        @forelse($hotels as $hotel)
            <div class="hotel-card">
                <div class="card-image">
                    @if($hotel->image)
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
                    @else
                        <div class="image-placeholder">
                            <i class="fa-solid fa-hotel"></i>
                        </div>
                    @endif
                    <div class="card-badge">
                        <span class="stars">{!! str_repeat('★', $hotel->stars) !!}</span>
                    </div>
                </div>
                <div class="card-content">
                    <h3>{{ $hotel->name }}</h3>
                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i> {{ $hotel->city }}
                    </p>
                    <p class="address">{{ $hotel->address }}</p>
                    <div class="price-row">
                        <span class="price">RM {{ number_format($hotel->price_per_night, 2) }}</span>
                        <span class="per-night">/ night</span>
                    </div>
                    <a href="{{ route('hotels.show', $hotel) }}" class="btn-details">
                        View Details <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="no-results">
                <i class="fa-regular fa-building"></i>
                <p>No hotels found for <strong>{{ request('city') }}</strong>.</p>
                <a href="{{ route('hotels.index') }}" class="btn-clear">Show all hotels</a>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $hotels->withQueryString()->links() }}
    </div>
</div>

<style>
    .hotels-page {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Hero section */
    .hero-section {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .hero-section h1 {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #0f2b3d, #1e6a8f);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
    }
    .hero-section p {
        color: #5b7e9c;
        font-size: 1rem;
    }

    /* Filter bar */
    .filter-bar {
        background: white;
        border-radius: 60px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 0.5rem;
        margin-bottom: 2.5rem;
        display: inline-block;
        width: auto;
    }
    .filter-form {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        flex-wrap: wrap;
    }
    .filter-group {
        position: relative;
        display: flex;
        align-items: center;
        background: #f8fafc;
        border-radius: 40px;
        padding: 0 1rem;
    }
    .filter-group i {
        color: #8aa0b5;
        font-size: 1rem;
    }
    .filter-group select {
        border: none;
        background: transparent;
        padding: 0.7rem 1rem 0.7rem 0.5rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        cursor: pointer;
        outline: none;
    }
    .btn-filter, .btn-clear {
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-filter {
        background: #0f2b3d;
        color: white;
    }
    .btn-filter:hover {
        background: #1f4b6e;
        transform: translateY(-1px);
    }
    .btn-clear {
        background: #eef2f8;
        color: #2c5a7a;
    }
    .btn-clear:hover {
        background: #e2e8f0;
    }

    /* Hotels grid */
    .hotels-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    /* Hotel card */
    .hotel-card {
        background: white;
        border-radius: 1.2rem;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #edf2f7;
    }
    .hotel-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
    }
    .card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .hotel-card:hover .card-image img {
        transform: scale(1.05);
    }
    .image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(145deg, #eef2f8, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #8aa0b5;
    }
    .card-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        font-size: 0.8rem;
        color: #f5b042;
    }
    .card-content {
        padding: 1.2rem;
    }
    .card-content h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #1e2f3e;
    }
    .location {
        font-size: 0.85rem;
        color: #2c6e9e;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .address {
        font-size: 0.8rem;
        color: #6c7e94;
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    .price-row {
        margin: 1rem 0;
        display: flex;
        align-items: baseline;
        gap: 5px;
    }
    .price {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f4b6e;
    }
    .per-night {
        font-size: 0.75rem;
        color: #6c7e94;
    }
    .btn-details {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f0f4fa;
        color: #1f4b6e;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.8rem;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-details:hover {
        background: #e2e8f0;
        gap: 12px;
    }

    /* No results */
    .no-results {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 1.5rem;
        grid-column: 1 / -1;
    }
    .no-results i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }
    .no-results p {
        color: #4a627a;
        margin-bottom: 1rem;
    }

    /* Pagination */
    /* Style for simple pagination (prev/next) */
.pagination-wrapper .pagination {
    display: flex;
    gap: 1rem;
    list-style: none;
    padding: 0;
}
.pagination-wrapper .page-item {
    display: inline-block;
}
.pagination-wrapper .page-link {
    display: inline-block;
    background: #0f2b3d;
    color: white;
    padding: 0.5rem 1.2rem;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}
.pagination-wrapper .page-link:hover {
    background: #1f4b6e;
    transform: translateY(-1px);
}
.pagination-wrapper .disabled .page-link {
    background: #cbd5e1;
    cursor: not-allowed;
    opacity: 0.6;
}

    /* Responsive */
    @media (max-width: 768px) {
        .hotels-page { padding: 1rem; }
        .filter-bar { width: 100%; border-radius: 30px; }
        .filter-form { width: 100%; justify-content: center; }
        .hero-section h1 { font-size: 1.8rem; }
        .hotels-grid { gap: 1rem; }
    }
</style>
@endsection