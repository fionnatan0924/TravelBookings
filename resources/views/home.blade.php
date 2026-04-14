@extends('app')

@section('content')
<style>
    .card-hover {
        transition: transform 0.22s ease, box-shadow 0.22s ease;
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
        padding: 30px;
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
        padding: 60px 0;
    }

    .section-gap-light {
        background: #f8fafc;
    }

    .grid-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
    }

    .card-image {
        min-height: 160px;
        background-size: cover;
        background-position: center;
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
        min-width: 140px;
    }

    .button-secondary {
        background: #f8fafc;
        color: #111827;
        border: 1px solid #d1d5db;
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
</style>

{{-- Hero Section --}}
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <h1 class="hero-title">Travel the world on your terms</h1>
            <p class="hero-text">Flights, hotels, combos, and attractions — all in one place with a clean, simple travel experience.</p>
            <div style="display: flex; flex-wrap: wrap; gap: 16px;">
                <a href="{{ url('/flights') }}" class="button button-primary">Search flights →</a>
                <a href="#combo" class="button button-secondary">Explore combos</a>
            </div>
        </div>
        <div class="hero-image" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=900&h=700&fit=crop');"></div>
    </div>
</section>

{{-- Search Bar --}}
<section class="section-gap">
    <div class="container">
        <div class="search-panel">
            <form action="{{ route('combos.search') }}" method="GET" class="search-grid">
                <input type="text" name="destination" placeholder="Destination" class="search-field">
                <input type="date" name="check_in" placeholder="Check in" class="search-field">
                <input type="date" name="check_out" placeholder="Check out" class="search-field">
                <select name="type" class="search-select">
                    <option value="">Combo type</option>
                    <option value="beach">Beach</option>
                    <option value="adventure">Adventure</option>
                    <option value="cultural">Cultural</option>
                </select>
                <button type="submit" class="button button-primary">Search</button>
            </form>
        </div>
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
                    ['from' => 'Kuala Lumpur', 'to' => 'Bali', 'price' => 299, 'original' => 450, 'airline' => 'AirAsia', 'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400&h=250&fit=crop'],
                    ['from' => 'Singapore', 'to' => 'Tokyo', 'price' => 499, 'original' => 750, 'airline' => 'SIA', 'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop'],
                    ['from' => 'Kuala Lumpur', 'to' => 'Bangkok', 'price' => 189, 'original' => 280, 'airline' => 'Malaysia Airlines', 'image' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=400&h=250&fit=crop'],
                    ['from' => 'Penang', 'to' => 'Phuket', 'price' => 159, 'original' => 250, 'airline' => 'Firefly', 'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=400&h=250&fit=crop'],
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
                    'to' => 'Bangkok',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'Grande Centre Point',
                    'hotel_rating' => 5,
                    'price' => 1814,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Guangzhou',
                    'airline' => 'AirAsia Berhad (Malaysia)',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'ARTHUR HOTEL',
                    'hotel_rating' => 4.5,
                    'price' => 1196,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Singapore',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'PARKROYAL on Beach Road',
                    'hotel_rating' => 4.5,
                    'price' => 1196,
                    'badge' => null,
                ],
                [
                    'from' => 'Kuala Lumpur',
                    'to' => 'Langkawi',
                    'airline' => 'Malaysia Airlines',
                    'flight_date' => 'Jun 15 - Jun 17',
                    'hotel_name' => 'Holiday Villa Beach Resort',
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
            @foreach($combos as $combo)
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
            <a href="#" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>
        <div class="grid-cards">
            @php
                $hotels = [
                    ['name' => 'The Ritz-Carlton', 'location' => 'Tokyo', 'price' => 450, 'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=400&h=250&fit=crop'],
                    ['name' => 'Marina Bay Sands', 'location' => 'Singapore', 'price' => 380, 'image' => 'https://images.unsplash.com/photo-1535827841776-24afc1e255ac?w=400&h=250&fit=crop'],
                    ['name' => 'Banyan Tree', 'location' => 'Bali', 'price' => 290, 'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&h=250&fit=crop'],
                    ['name' => 'Shangri-La', 'location' => 'Kuala Lumpur', 'price' => 210, 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop'],
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

{{-- Destinations Section (Carousel with arrows, no clipping) --}}
<section class="section-gap section-gap-light">
    <div class="container" style="overflow: visible;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
            <div>
                <h2 class="section-title">Popular Destinations</h2>
                <p class="section-subtitle">Explore top cities around the world.</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="button button-secondary" style="padding: 12px 20px;">View all</a>
        </div>

        {{-- Carousel wrapper with clear overflow control --}}
        <div style="position: relative; width: 100%; overflow: visible;">
            {{-- Left Arrow --}}
            <button id="destPrevBtn" style="position: absolute; left: -20px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; background: white; border: 1px solid #ddd; cursor: pointer; z-index: 20; box-shadow: 0 2px 8px rgba(0,0,0,0.1); font-size: 24px; display: flex; align-items: center; justify-content: center;">
                ‹
            </button>

            {{-- Scroll container --}}
            <div id="destinationsCarousel" style="overflow-x: auto; overflow-y: hidden; white-space: nowrap; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; padding: 10px 0; margin: 0 -10px;">
                <div style="display: inline-flex; gap: 20px; padding: 0 10px;">
                    @foreach($destinations as $dest)
                    <a href="{{ route('destinations.show', $dest->id) }}" style="text-decoration: none; color: inherit; display: inline-block; width: 200px; flex-shrink: 0;">
                        <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s;">
                            <div style="height: 140px; background: url('{{ $dest->image_url ?? 'https://via.placeholder.com/200x140?text=No+Image' }}') center/cover;"></div>
                            <div style="padding: 12px;">
                                <h3 style="font-size: 16px; margin-bottom: 4px;">{{ $dest->name }}</h3>
                                <p style="color: #666; font-size: 12px;">{{ $dest->packages_count }} combos</p>
                                <p style="margin-top: 8px; font-size: 14px; font-weight: 500;">from RM {{ number_format($dest->starting_price) }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Right Arrow --}}
            <button id="destNextBtn" style="position: absolute; right: -20px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; background: white; border: 1px solid #ddd; cursor: pointer; z-index: 20; box-shadow: 0 2px 8px rgba(0,0,0,0.1); font-size: 24px; display: flex; align-items: center; justify-content: center;">
                ›
            </button>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="section-gap section-gap-light">
    <div class="container">
        <div style="text-align: center; margin-bottom: 36px;">
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
    const scrollAmount = 220; // card width 200px + gap 20px

    if (carousel && prevBtn && nextBtn) {
        function updateButtons() {
            const scrollLeft = carousel.scrollLeft;
            const maxScroll = carousel.scrollWidth - carousel.clientWidth;
            prevBtn.style.display = scrollLeft > 0 ? 'flex' : 'none';
            nextBtn.style.display = scrollLeft < maxScroll - 1 ? 'flex' : 'none';
        }

        carousel.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);
        updateButtons();

        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    }
});
</script>

@endsection