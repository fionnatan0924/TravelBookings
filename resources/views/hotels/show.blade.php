@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
<div class="hotel-detail">
    <!-- Hero Section with Main Image -->
    <div class="hero-image">
        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
        <div class="hero-overlay">
            <h1>{{ $hotel->name }}</h1>
            <div class="stars">{!! str_repeat('★', $hotel->stars) !!}</div>
        </div>
    </div>

    <div class="detail-container">
        <div class="detail-main">
            <!-- Description -->
            <div class="section">
                <h2>About the Hotel</h2>
                <p>{{ $hotel->description ?? 'Experience comfort and convenience at '.$hotel->name.'. Our hotel offers modern amenities and exceptional service.' }}</p>
            </div>

            <!-- Gallery -->
            @if(!empty($gallery))
            <div class="section">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    @foreach($gallery as $img)
                        <img src="{{ $img }}" alt="Gallery image">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Amenities -->
            <div class="section">
                <h2>Amenities</h2>
                <div class="amenities-list">
                    @php
                        $amenitiesArray = explode(',', $hotel->amenities ?? 'Free Wi-Fi, Air Conditioning, 24-hour Front Desk');
                    @endphp
                    @foreach($amenitiesArray as $amenity)
                        <span class="amenity-badge"><i class="fa-solid fa-check"></i> {{ trim($amenity) }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Location & Map (placeholder) -->
            <div class="section">
                <h2>Location</h2>
                <p><i class="fa-solid fa-location-dot"></i> {{ $hotel->address }}, {{ $hotel->city }}</p>
                <div class="map-placeholder">
                    <iframe 
                        width="100%" 
                        height="300" 
                        style="border:0; border-radius: 1rem;" 
                        loading="lazy" 
                        allowfullscreen 
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={{ urlencode($hotel->address) }}">
                    </iframe>
                    <p class="map-note">* Google Maps integration – replace with your API key</p>
                </div>
            </div>
        </div>

        <div class="detail-sidebar">
            <div class="booking-card">
                <div class="price-box">
                    <span class="price">RM {{ number_format($hotel->price_per_night, 2) }}</span>
                    <span class="per-night">/ night</span>
                </div>
                <div class="check-info">
                    <div><i class="fa-regular fa-clock"></i> Check-in: {{ $hotel->check_in_time ?? '14:00' }}</div>
                    <div><i class="fa-regular fa-clock"></i> Check-out: {{ $hotel->check_out_time ?? '12:00' }}</div>
                </div>
                <form action="{{ route('combo.search') }}" method="GET" class="quick-book">
                    <input type="hidden" name="destination" value="{{ $hotel->city }}">
                    <input type="hidden" name="origin" value="KUL">
                    <input type="date" name="departure_date" placeholder="Check-in" required>
                    <input type="date" name="check_out" placeholder="Check-out" required>
                    <input type="number" name="guests" value="1" min="1">
                    <button type="submit" class="book-btn">Book as Combo <i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <p class="note">* Combine with flight for best price</p>
            </div>
        </div>
    </div>
</div>

<style>
    .hotel-detail {
        max-width: 1280px;
        margin: 0 auto;
        background: #f3f6fc;
    }
    .hero-image {
        position: relative;
        height: 450px;
        overflow: hidden;
    }
    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 2rem;
    }
    .hero-overlay h1 {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
    }
    .hero-overlay .stars {
        color: #f5b042;
        font-size: 1.2rem;
    }
    .detail-container {
        display: flex;
        gap: 2rem;
        padding: 2rem;
        flex-wrap: wrap;
    }
    .detail-main {
        flex: 2;
        min-width: 300px;
    }
    .detail-sidebar {
        flex: 1;
        min-width: 280px;
    }
    .section {
        background: white;
        border-radius: 1.2rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .section h2 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: #1f4b6e;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }
    .gallery-grid img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 0.8rem;
        transition: transform 0.2s;
        cursor: pointer;
    }
    .gallery-grid img:hover {
        transform: scale(1.02);
    }
    .amenities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    .amenity-badge {
        background: #f0f4fa;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .map-placeholder {
        margin-top: 1rem;
        border-radius: 1rem;
        overflow: hidden;
    }
    .map-note {
        font-size: 0.7rem;
        color: #6c7e94;
        margin-top: 0.3rem;
    }
    .booking-card {
        background: white;
        border-radius: 1.2rem;
        padding: 1.5rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
    }
    .price-box {
        text-align: center;
        border-bottom: 1px solid #eef2f8;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .price-box .price {
        font-size: 2rem;
        font-weight: 800;
        color: #1f4b6e;
    }
    .check-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #4a627a;
    }
    .quick-book input, .quick-book select {
        width: 100%;
        padding: 0.6rem;
        margin-bottom: 0.8rem;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
    }
    .book-btn {
        width: 100%;
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 40px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .book-btn:hover {
        background: #1f4b6e;
        transform: translateY(-2px);
    }
    .note {
        font-size: 0.7rem;
        color: #6c7e94;
        text-align: center;
        margin-top: 1rem;
    }
    @media (max-width: 768px) {
        .hero-image { height: 250px; }
        .hero-overlay h1 { font-size: 1.5rem; }
        .detail-container { padding: 1rem; flex-direction: column; }
        .booking-card { position: static; }
    }
</style>

<!-- Optional: simple lightbox for gallery -->
<script>
    document.querySelectorAll('.gallery-grid img').forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.style.position = 'fixed';
            lightbox.style.top = 0;
            lightbox.style.left = 0;
            lightbox.style.width = '100%';
            lightbox.style.height = '100%';
            lightbox.style.backgroundColor = 'rgba(0,0,0,0.9)';
            lightbox.style.display = 'flex';
            lightbox.style.alignItems = 'center';
            lightbox.style.justifyContent = 'center';
            lightbox.style.zIndex = 9999;
            lightbox.style.cursor = 'pointer';
            const clone = img.cloneNode();
            clone.style.maxWidth = '90%';
            clone.style.maxHeight = '90%';
            clone.style.borderRadius = '1rem';
            lightbox.appendChild(clone);
            lightbox.onclick = () => lightbox.remove();
            document.body.appendChild(lightbox);
        });
    });
</script>
@endsection