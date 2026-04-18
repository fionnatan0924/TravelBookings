@extends('app')

@section('content')
<style>
    .card,
    .card-hover {
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        border-radius: 14px;
    overflow: hidden;
    background: white;
    }

    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 44px rgba(15, 23, 42, 0.12);
    }

    .hero {
        padding: 80px 0;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }

    .hero-title {
        font-size: clamp(2.75rem, 5vw, 4rem);
        line-height: 1.05;
        margin-bottom: 1.25rem;
        max-width: 620px;
    }

    .hero-text {
        color: #4b5563;
        max-width: 520px;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .hero-image {
        min-height: 420px;
        border-radius: 28px;
        background-size: cover;
        background-position: center;
    }

    .search-panel {
        border-radius: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        padding: 20px;
        background: #ffffff;
    }

    .search-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 18px;
    }

    .search-field,
    .search-select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 16px;
        border: 1px solid #d1d5db;
        background: #f8fafc;
        color: #111827;
    }

    .section-heading {
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #6b7280;
        margin-bottom: 1.75rem;
    }

    .section-gap {
        padding: 30px 0;
    }

    .section-gap-light {
        background: #f8fafc;
    }

    .grid-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 0.5fr));
        gap: 24px;
    }

    .card-image {
        min-height: 160px;
        background-size: cover;
        background-position: center;
        border-radius: 0;
    }

    .card-content {
        padding: 1.25rem;
    }

    .card-meta {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 0.85rem;
    }

    .card-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
    }

    .card-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 0.85rem;
        font-size: 0.8rem;
        color: #111827;
        background: #f8fafc;
        border-radius: 999px;
    }

    .button-primary {
        background: #111827;
        color: #ffffff;
        min-width: 120px;
    }

    .button-secondary {
        background: #f8fafc;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    .attraction-filter {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .attraction-filter select {
        min-width: 220px;
        max-width: 100%;
    }

    .attraction-group {
        display: none;
    }

    .attraction-group.active {
        display: block;
    }
    .attraction-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);  
    gap: 20px;
}

.attraction-card {
    width: 100%;
    
}
.attraction-card {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.attraction-card .card {
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.attraction-card .card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.attraction-card .button-primary {
    width: 100%;
    padding: 8px 16px;
    font-size: 0.9rem;
    display: block;
    margin: 0 auto;
}


    .destination-carousel {
        position: relative;
    }

    .destination-inner {
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
        scroll-behavior: smooth;
        margin: 0 -8px;
        padding: 8px 8px 8px 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .destination-inner::-webkit-scrollbar {
        display: none;
        height: 0;
    }

    .destination-item {
        display: inline-block;
        width: 210px;
        margin-right: 18px;
        vertical-align: top;
    }

    .destination-card {
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #ffffff;
    }

    .destination-card__image {
        min-height: 140px;
        background-size: cover;
        background-position: center;
    }

    .destination-card__body {
        padding: 1rem;
    }

    .carousel-control {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #d1d5db;
    background: white;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    font-size: 24px;
    font-weight: 600;
    color: #1f2937;
    transition: all 0.2s ease;
}

.carousel-control:hover {
    background: #f3f4f6;
    transform: translateY(-50%) scale(1.05);
}

.carousel-control.hidden {
    display: none;
}



    @media (max-width: 900px) {
        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-image {
            min-height: 320px;
        }

        .destination-item {
            width: 190px;
        }
        .attraction-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    }

    @media (max-width: 700px) {
        .hero {
            padding: 50px 0;
        }

        .section-gap {
            padding: 50px 0;
        }

        .search-panel {
            padding: 24px;
        }
    }
    
@media (max-width: 600px) {
    .attraction-grid {
        grid-template-columns: 1fr;
    }
}
    
#destinationsCarousel::-webkit-scrollbar {
    display: none;
}
#destinationsCarousel {
    -ms-overflow-style: none;
    scrollbar-width: none;
}


.section-gap-light {
    background: #f8fafc;
}
</style>

{{-- Hero Section --}}
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <h1 class="hero-title">Explore the World with ease</h1>
            <p class="hero-text">Book flights, hotels, and travel packages all in one place.<br>
            Simple, fast, and designed for modern travelers.</p>
            <div style="display: flex; flex-wrap: wrap; gap: 16px;">
                <a href="{{ url('/flights') }}" class="button button-primary">Search flights →</a>
                <a href="#combo" class="button button-secondary">Explore combos</a>
            </div>
        </div>
        <div class="hero-image" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=900&h=700&fit=crop');"></div>
    </div>
</section>

{{-- Flights Section --}}
<section class="section-gap">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
            <div>
                <h2 class="section-title">Flights</h2>
                <p class="section-subtitle">Best deals on domestic & international travel.</p>
            </div>
            <a href="{{ url('/flights') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>
        <div class="grid-cards">
            @php
                $flightDeals = [
                    ['from' => 'Kuala Lumpur', 'to' => 'Bali', 'price' => 400, 'original' => 600, 'airline' => 'AirAsia', 'image' => 'https://www.hostelworld.com/blog/wp-content/uploads/dreamstimesmall_322299871.jpg'],
                    ['from' => 'Singapore', 'to' => 'Bangkok', 'price' => 1200, 'original' => 1500, 'airline' => 'Singapore Airlines', 'image' => 'https://samaaratravel.com/assets/img/tour/thailand/thailand19.jpg'],
                    ['from' => 'Kuala Lumpur', 'to' => 'Tokyo', 'price' => 280, 'original' => 400, 'airline' => 'Malaysia Airlines', 'image' => 'https://www.advantour.com/img/japan/images/tokyo.jpg'],
                    ['from' => 'Penang', 'to' => 'Vietnam', 'price' => 380, 'original' => 570, 'airline' => 'Firefly', 'image' => 'https://www.travellikeanna.com/wp-content/uploads/2024/11/Mazurek_Ha_Long_Bay.jpg'],
                ];
            @endphp
            @foreach($flightDeals as $deal)
            <a href="{{ url('/flights') }}" style="text-decoration: none; color: inherit;">
                <div class="card card-hover">
                    <div class="card-image" style="background-image: url('{{ $deal['image'] }}');"></div>
                    <div class="card-content">
                        <div style="font-weight: 700; margin-bottom: 0.45rem;">{{ $deal['from'] }} → {{ $deal['to'] }}</div>
                        <div class="card-meta">{{ $deal['airline'] }}</div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                            <span style="color: #6b7280; text-decoration: line-through;">RM {{ $deal['original'] }}</span>
                            <span class="card-price">RM {{ $deal['price'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Combo Deals Section (Flight + Hotel) --}}
<section id="combo" class="section-gap section-gap-light">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
            <div>
                <h2 class="section-title">Combo Deals</h2>
                <p class="section-subtitle">Flight + hotel packages with simple pricing and clean stay options.</p>
            </div>
            <a href="{{ route('combos.index') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>

        {{-- Sample Combo Data (matches the image style) --}}
        @php
            $combos = [
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'ShangHai',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'The Bund Riverside Hotel',
                    'hotel_rating' => 5,
                    'price' => 1814,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Hong Kong',
                    'airline' => 'AirAsia Berhad (Malaysia)',
                    'flight_date' => 'Sep 01 - Sep 10',
                    'hotel_name' => 'Victoria Harbour Hotel',
                    'hotel_rating' => 4.5,
                    'price' => 1196,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Maldives',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'Jan 04 - Jun 07',
                    'hotel_name' => 'Overwater Bungalow Resort',
                    'hotel_rating' => 4.5,
                    'price' => 1196,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Chiang Mai',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'March 11 - March 15',
                    'hotel_name' => 'Old City Boutique Hotel',
                    'hotel_rating' => 4.5,
                    'price' => 673,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Shanghai',
                    'airline' => 'AirAsia Berhad (Malaysia)',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'Shanghai Bund Hotel',
                    'hotel_rating' => 4.5,
                    'price' => 2635,
                    'badge' => '+ RM 2,000 OFF',
                ],
            ];
        @endphp

        <div class="grid-cards">
            @foreach(array_slice($combos, 0, 4) as $combo)
            <div class="card card-hover">
                <div class="card-content">
                    <div style="font-weight: 700; font-size: 1.02rem; margin-bottom: 0.75rem;">{{ $combo['from'] }} → {{ $combo['to'] }}</div>
                    <div class="card-meta">{{ $combo['airline'] }}</div>
                    <div style="color: #6b7280; font-size: 0.95rem; margin-bottom: 1rem;">{{ $combo['flight_date'] }}</div>

                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 1rem; flex-wrap: wrap;">
                        <span style="font-weight: 600;">{{ $combo['hotel_name'] }}</span>
                        <span style="color: #f59e0b;">@for($i = 1; $i <= floor($combo['hotel_rating']); $i++) ★ @endfor @if($combo['hotel_rating'] - floor($combo['hotel_rating']) >= 0.5) ½ @endif</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <div>
                            <span class="card-price">RM {{ number_format($combo['price']) }}</span>
                            <span style="color: #6b7280; font-size: 0.95rem;">/ person</span>
                        </div>
                        @if($combo['badge'])
                            <span class="card-badge">{{ $combo['badge'] }}</span>
                        @endif
                    </div>

                    <button class="button button-primary" style="width: 100%; margin-top: 1.2rem;">Book Now</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Hotel Section --}}
<section class="section-gap">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
            <div>
                <h2 class="section-title">Hotels</h2>
                <p class="section-subtitle">Stay at the best properties worldwide.</p>
            </div>
            <a href="{{ route('hotels.index') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>
        <div class="grid-cards">
            @php
                $hotels = [
                    ['name' => 'Marina Bay Sands View Hotel', 'location' => 'Tokyo', 'price' => 450, 'image' => 'https://www.marinabaysands.com/content/dam/marinabaysands/hotel/the-sands-collection-landing-page/room-listing/sands-premier-studio-1.jpg'],
                    ['name' => 'Chinatown Boutique Inn', 'location' => 'Singapore', 'price' => 380, 'image' => 'https://www.myboutiquehotel.com/photos/110247/duxton-reserve-singapore-autograph-collection-singapore-121-02758-728x400.jpg'],
                    ['name' => 'JB City Square Hotel', 'location' => 'Johor Bahru', 'price' => 290, 'image' => 'https://images.trvl-media.com/lodging/114000000/113320000/113314700/113314662/3d995094_y.jpg'],
                    ['name' => 'Canton Tower Hotel', 'location' => 'GuangZhou', 'price' => 210, 'image' => 'https://www.fourseasons.com/alt/img-opt/~70.1530.0,0000-208,8816-3000,0000-1687,5000/publish/content/dam/fourseasons/images/web/GUA/GUA_1793_original.jpg'],
                ];
            @endphp
            @foreach($hotels as $hotel)
            <div class="card card-hover">
                <div class="card-image" style="background-image: url('{{ $hotel['image'] }}');"></div>
                <div class="card-content">
                    <h3 style="margin-bottom: 0.5rem;">{{ $hotel['name'] }}</h3>
                    <div class="card-meta">{{ $hotel['location'] }}</div>
                    <div style="margin-top: 1rem; font-weight: 700;">RM {{ $hotel['price'] }} <span style="color: #6b7280; font-weight: 500;">/night</span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Attractions Section --}}
<section class="section-gap">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
            <div>
                <h2 class="section-title">Attractions</h2>
                <p class="section-subtitle">Discover the best experiences in popular destinations.</p>
            </div>
            <a href="{{ route('attractions.index') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>

        <div class="attraction-filter">
            <label for="attraction-destination" style="font-weight: 600; color: #374151; margin-bottom: 0;">Filter by destination</label>
            <select id="attraction-destination" class="search-select">
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                @endforeach
            </select>
        </div>

        @if($attractionsByDestination->count())
            @foreach($attractionsByDestination as $dest)
                <div class="attraction-group" data-destination-id="{{ $dest->id }}" style="margin-bottom: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 18px;">
                        <div>
                            <h3 style="margin: 0 0 8px;">{{ $dest->name }}</h3>
                            <p style="color: #6b7280; margin: 0;">Popular attractions in {{ $dest->name }}.</p>
                        </div>
                        <a href="{{ route('destinations.show', $dest->id) }}" style="color: #111827; font-weight: 600; text-decoration: none;">Explore destination</a>
                    </div>

                    @if($dest->attractions->count())
                        <div class="attraction-grid">
    @foreach($dest->attractions as $attraction)
        <div class="attraction-card">
            <a href="{{ route('attractions.book', $attraction->id) }}" style="text-decoration: none; color: inherit;">
                <div class="card card-hover">
                    <div class="card-image" style="background-image: url('{{ $attraction->image_url ?? 'https://via.placeholder.com/400x250?text=No+Image' }}'); min-height: 160px;"></div>
                    <div class="card-content">
                        <div style="font-weight: 700; margin-bottom: 0.6rem;">{{ $attraction->name }}</div>
                        <div class="card-meta">{{ number_format($attraction->rating, 1) }} ★ · {{ $attraction->reviews }} reviews</div>
                        <div style="margin: 12px 0; font-size: 1rem; font-weight: 700;">RM {{ number_format($attraction->price, 2) }}</div>
                        <div style="color: #6b7280; font-size: 0.95rem; margin-bottom: 12px;">{{ $attraction->booking_text ?? 'Book your spot now' }}</div>
                        <button class="button button-primary">View attraction</button>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
                    @else
                        <div style="background: #f9fafb; border-radius: 16px; padding: 32px; text-align: center;">
                            <p>No active attractions in {{ $dest->name }} at the moment.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div style="background: white; border-radius: 16px; padding: 32px; text-align: center;">
                <p>No attractions available right now. Please check back later.</p>
            </div>
        @endif
    </div>
</section>

{{-- Destinations Section (Agoda style: small circle arrows + edge fade) --}}
<section class="section-gap section-gap-light">
    <div class="container" style="position: relative; overflow: visible;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
            <div>
                <h2 class="section-title">Popular Destinations</h2>
                <p class="section-subtitle">Explore top cities around the world.</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>

        {{-- Carousel wrapper with fade overlays --}}
        <div style="position: relative;">
            {{-- Left fade overlay --}}
            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 60px; z-index: 5; background: linear-gradient(to right, #f8fafc, transparent); pointer-events: none;"></div>

            {{-- Right fade overlay --}}
            <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 60px; z-index: 5; background: linear-gradient(to left, #f8fafc, transparent); pointer-events: none;"></div>

            {{-- Left Arrow (small circle, hidden initially) --}}
            <button id="destPrevBtn" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 28px; height: 28px; border-radius: 50%; background: white; border: 1px solid #e2e8f0; cursor: pointer; z-index: 20; box-shadow: 0 1px 4px rgba(0,0,0,0.08); font-size: 18px; font-weight: 600; display: none; align-items: center; justify-content: center; color: #334155; padding: 0; line-height: 1;">
                ‹
            </button>

            {{-- Scroll container (no visible scrollbar) --}}
            <div id="destinationsCarousel" style="overflow-x: auto; overflow-y: hidden; white-space: nowrap; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; padding: 10px 0;">
                <div style="display: inline-flex; gap: 20px; padding: 0 30px;">
                    @foreach($destinations as $dest)
                    <div style="display: inline-block; width: 260px; flex-shrink: 0;">
                        <div class="card card-hover" style="display: flex; flex-direction: column; height: 100%;">
                            <div class="card-image" style="background-image: url('{{ $dest->image_url ?? 'https://via.placeholder.com/260x140?text=No+Image' }}');"></div>
                            <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column;">
                                <h3 style="font-size: 16px; margin-bottom: 4px; flex-grow: 1;">{{ $dest->name }}</h3>
                                <p style="color: #666; font-size: 12px; margin-bottom: 0.75rem;">{{ $dest->packages_count }} combos</p>
                                <p style="margin-bottom: 0.75rem; font-size: 14px; font-weight: 500;">from RM {{ number_format($dest->starting_price) }}</p>
                                <a href="{{ url('/flights?to=' . urlencode($dest->name)) }}" class="button button-primary" style="width: 100%; padding: 6px 10px; font-size: 14px; text-align: center; margin-top: auto;">Search flight</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Arrow (small circle, visible) --}}
            <button id="destNextBtn" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); width: 28px; height: 28px; border-radius: 50%; background: white; border: 1px solid #e2e8f0; cursor: pointer; z-index: 20; box-shadow: 0 1px 4px rgba(0,0,0,0.08); font-size: 18px; font-weight: 600; display: flex; align-items: center; justify-content: center; color: #334155; padding: 0; line-height: 1;">
                ›
            </button>
        </div>
    </div>
</section>


{{-- Testimonials --}}
<section class="section-gap section-gap-light">
    <div class="container">
        <div style="text-align: left; margin-bottom: 36px;">
            <h2 class="section-title">What our travelers say</h2>
            <p class="section-subtitle">Real experiences from real people.</p>
        </div>
        <div class="grid-cards">
            @foreach($testimonials as $t)
            <div class="card card-hover" style="padding: 24px;">
                <p style="font-style: italic; color: #374151; margin-bottom: 20px;">"{{ $t->content }}"</p>
                <div style="font-weight: 700; margin-bottom: 0.35rem;">{{ $t->user->name ?? 'Traveler' }}</div>
                <div style="color: #6b7280; font-size: 0.95rem;">{{ $t->location }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section-gap" style="background: #111827; color: #ffffff;">
    <div class="container" style="display: grid; grid-template-columns: 1.2fr 0.8fr; align-items: center; gap: 28px;">
        <div>
            <h2 class="section-title" style="color: #ffffff;">Ready for your next adventure?</h2>
            <p style="color: rgba(255,255,255,0.8); max-width: 550px; margin-top: 0.75rem;">Sign up today and get RM 200 off your first booking.</p>
        </div>
        <div style="text-align: left;">
            <a href="#" class="button button-primary">Sign up for free</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('destinationsCarousel');
    const prevBtn = document.getElementById('destPrevBtn');
    const nextBtn = document.getElementById('destNextBtn');
    
    if (carousel && prevBtn && nextBtn) {
        const scrollAmount = 220; // card width 200px + gap 20px

        function updateArrows() {
            const scrollLeft = carousel.scrollLeft;
            const maxScroll = carousel.scrollWidth - carousel.clientWidth;

            if (scrollLeft > 10) {
                prevBtn.style.display = 'flex';
            } else {
                prevBtn.style.display = 'none';
            }

            if (maxScroll - scrollLeft > 10) {
                nextBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'none';
            }
        }

        carousel.addEventListener('scroll', updateArrows);
        window.addEventListener('resize', updateArrows);
        updateArrows();

        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    }

    const attractionSelect = document.getElementById('attraction-destination');
    const attractionGroups = document.querySelectorAll('.attraction-group');

    function updateAttractionGroups() {
        const selectedId = attractionSelect ? attractionSelect.value : null;
        attractionGroups.forEach(group => {
            if (selectedId && group.dataset.destinationId == selectedId) {
                group.classList.add('active');
            } else {
                group.classList.remove('active');
            }
        });
    }

    if (attractionSelect && attractionGroups.length) {
        attractionSelect.addEventListener('change', updateAttractionGroups);
        updateAttractionGroups();
    }

    // Search bar navigation
    const pageSelect = document.getElementById('page-select');
    const destinationSelect = document.getElementById('destination-select');
    const checkInInput = document.getElementById('check-in');
    const checkOutInput = document.getElementById('check-out');
    const passengersInput = document.getElementById('passengers');

    if (pageSelect) {
        pageSelect.addEventListener('change', function() {
            const selectedPage = this.value;
            const destinationId = destinationSelect ? destinationSelect.value : '';
            const checkIn = checkInInput ? checkInInput.value : '';
            const checkOut = checkOutInput ? checkOutInput.value : '';
            const passengers = passengersInput ? passengersInput.value : '';

            if (!selectedPage) return;

            let url = '';

            switch(selectedPage) {
                case 'destinations':
                    if (destinationId) {
                        url = `{{ url('/destinations') }}/${destinationId}`;
                    } else {
                        url = '{{ route("destinations.index") }}';
                    }
                    break;
                case 'flights':
                    url = '{{ route("flights.index") }}';
                    if (destinationId) {
                        const destName = destinationSelect.options[destinationSelect.selectedIndex].text;
                        url += `?to=${encodeURIComponent(destName)}`;
                        if (checkIn) url += `&departure_date=${checkIn}`;
                        if (passengers) url += `&passengers=${passengers}`;
                    }
                    break;
                case 'hotels':
                    url = '{{ route("hotels.index") }}';
                    if (destinationId) {
                        url += `?destination_id=${destinationId}`;
                    }
                    break;
                case 'combos':
                    url = '{{ route("combos.index") }}';
                    if (destinationId) {
                        const destName = destinationSelect.options[destinationSelect.selectedIndex].text;
                        url += `?destination=${encodeURIComponent(destName)}`;
                        if (checkIn) url += `&check_in=${checkIn}`;
                        if (checkOut) url += `&check_out=${checkOut}`;
                    }
                    break;
                case 'attractions':
                    url = '{{ route("attractions.index") }}';
                    if (destinationId) {
                        url += `?destination_id=${destinationId}`;
                    }
                    break;
            }

            if (url) {
                window.location.href = url;
            }
        });
    }
});
</script>

@endsection