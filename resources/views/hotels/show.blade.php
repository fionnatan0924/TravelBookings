@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
<div class="hotel-detail">
    <!-- Hero Section -->
    <div class="hero-wrapper">
        <div class="hero-image">
            <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
            <div class="hero-overlay">
                <h1>{{ $hotel->name }}</h1>
                <div class="stars">{!! str_repeat('★', $hotel->stars) !!}</div>
            </div>
        </div>
    </div>

    <div class="detail-container">
        <!-- Left column: info -->
        <div class="detail-main">
            <!-- Description -->
            <div class="section">
                <h2>About the Hotel</h2>
                <p>{{ $hotel->description ?? 'Experience comfort and convenience at '.$hotel->name.'. Our hotel offers modern amenities and exceptional service.' }}</p>
            </div>

            <!-- Gallery -->
            @php
                $galleryImages = $hotel->gallery ? json_decode($hotel->gallery, true) : [];
            @endphp
            @if(!empty($galleryImages))
            <div class="section">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    @foreach($galleryImages as $img)
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

            <!-- Location & Map -->
            <div class="section">
                <h2>Location</h2>
                <p class="address-full"><i class="fa-solid fa-location-dot"></i> {{ $hotel->address }}, {{ $hotel->city }}</p>
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

        <!-- Right column: booking card (sticky) -->
        <div class="detail-sidebar">
            <div class="booking-card">
                <div class="price-tag">
                    <span class="currency">RM</span>
                    <span class="amount">{{ number_format($hotel->price_per_night, 2) }}</span>
                    <span class="unit">/ night</span>
                </div>
                <div class="divider"></div>
                <form action="{{ route('hotel.book.form', $hotel) }}" method="POST" class="booking-form">
                    @csrf
                    <div class="form-field">
                        <label>Check-in</label>
                        <input type="date" name="check_in" required>
                    </div>
                    <div class="form-field">
                        <label>Check-out</label>
                        <input type="date" name="check_out" required>
                    </div>
                    <div class="form-field">
                        <label>Guests</label>
                        <input type="number" name="guests" value="1" min="1" max="10" required>
                    </div>
                    <button type="submit" class="book-now-btn">Book Now <i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <p class="note">* No payment taken now – you will confirm later</p>
            </div>
        </div>
    </div>
</div>

<style>
    .hotel-detail {
        max-width: 1280px;
        margin: 0 auto;
        background: #f5f7fc;
    }

    /* Hero wrapper */
    .hero-wrapper {
        padding: 1.5rem 1.5rem 0 1.5rem;
    }
    .hero-image {
        position: relative;
        height: 320px;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .hero-image:hover img {
        transform: scale(1.02);
    }
    .hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 1.5rem 2rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .hero-overlay h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        letter-spacing: -0.5px;
    }
    .hero-overlay .stars {
        color: #f5b042;
        font-size: 1rem;
        letter-spacing: 2px;
    }

    /* Two-column layout */
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

    /* Info cards */
    .section {
        background: white;
        border-radius: 1.5rem;
        padding: 1.8rem;
        margin-bottom: 1.8rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .section:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    .section h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        color: #1f3b4c;
        border-left: 4px solid #1f4b6e;
        padding-left: 0.8rem;
    }

    /* Gallery */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
    }
    .gallery-grid img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        border-radius: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .gallery-grid img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Amenities */
    .amenities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    .amenity-badge {
        background: #eef2fa;
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1f4b6e;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }
    .amenity-badge i {
        color: #2c6e9e;
        font-size: 0.8rem;
    }
    .amenity-badge:hover {
        background: #e2e8f0;
        transform: translateY(-1px);
    }

    /* Location */
    .address-full {
        font-size: 1rem;
        margin-bottom: 1rem;
        color: #2c5a7a;
    }
    .map-placeholder {
        margin-top: 1rem;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .map-note {
        font-size: 0.7rem;
        color: #6c7e94;
        margin-top: 0.5rem;
        text-align: center;
    }

    /* Booking card (right sidebar) */
    .booking-card {
        background: white;
        border-radius: 1.5rem;
        padding: 1.8rem;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 100px;
    }
    .price-tag {
        text-align: center;
        margin-bottom: 1rem;
    }
    .currency {
        font-size: 1rem;
        font-weight: 500;
        color: #4a627a;
        vertical-align: top;
    }
    .amount {
        font-size: 2.4rem;
        font-weight: 800;
        color: #1f4b6e;
        line-height: 1;
    }
    .unit {
        font-size: 0.9rem;
        color: #6c7e94;
    }
    .divider {
        height: 2px;
        background: #eef2f8;
        margin: 1rem 0;
    }
    .booking-form .form-field {
        margin-bottom: 1rem;
    }
    .booking-form label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #4b6b8f;
        margin-bottom: 0.3rem;
    }
    .booking-form input {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        font-family: 'Inter', sans-serif;
        transition: 0.2s;
    }
    .booking-form input:focus {
        border-color: #1f4b6e;
        outline: none;
        box-shadow: 0 0 0 3px rgba(31,75,110,0.1);
    }
    .book-now-btn {
        width: 100%;
        background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 40px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        margin-top: 0.5rem;
    }
    .book-now-btn:hover {
        background: linear-gradient(105deg, #1a3a52, #28638b);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    }
    .note {
        font-size: 0.7rem;
        color: #6c7e94;
        text-align: center;
        margin-top: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-wrapper { padding: 1rem; }
        .hero-image { height: 220px; border-radius: 1rem; }
        .hero-overlay h1 { font-size: 1.4rem; }
        .hero-overlay { padding: 1rem; }
        .detail-container { padding: 1rem; flex-direction: column; }
        .booking-card { position: static; }
        .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); }
        .section h2 { font-size: 1.3rem; }
    }
</style>

<!-- Lightbox for gallery -->
<script>
    document.querySelectorAll('.gallery-grid img').forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.style.position = 'fixed';
            lightbox.style.top = 0;
            lightbox.style.left = 0;
            lightbox.style.width = '100%';
            lightbox.style.height = '100%';
            lightbox.style.backgroundColor = 'rgba(0,0,0,0.92)';
            lightbox.style.display = 'flex';
            lightbox.style.alignItems = 'center';
            lightbox.style.justifyContent = 'center';
            lightbox.style.zIndex = 9999;
            lightbox.style.cursor = 'pointer';
            const clone = img.cloneNode();
            clone.style.maxWidth = '90%';
            clone.style.maxHeight = '90%';
            clone.style.borderRadius = '1rem';
            clone.style.boxShadow = '0 20px 40px rgba(0,0,0,0.4)';
            lightbox.appendChild(clone);
            lightbox.onclick = () => lightbox.remove();
            document.body.appendChild(lightbox);
        });
    });
</script>
@endsection