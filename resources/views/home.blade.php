@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero">
    <div class="hero-grid">
        <div class="hero-copy">
            <h1 class="hero-title">Your journey,<br>simplified.</h1>
            <p class="hero-text">Book flights, hotels, and combos in one place. Travel smarter with Travelio.</p>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('flights.search') }}" class="button button-primary">Search Flights</a>
                <a href="{{ route('hotels.index') }}" class="button button-muted">Find Hotels</a>
            </div>
        </div>
        <div class="hero-image" style="background-image: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center; min-height: 400px; border-radius: 28px;"></div>
    </div>
</div>

<div class="section-gap">
    <div class="container">
        <h2 class="section-title">Why travel with us</h2>
        <div class="grid-cards">
            <div class="card card-hover">
                <div class="card-body">
                    <i class="fa-solid fa-plane" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <h3>Best flight deals</h3>
                    <p>Compare airlines and save up to 30% on your next trip.</p>
                </div>
            </div>
            <div class="card card-hover">
                <div class="card-body">
                    <i class="fa-solid fa-hotel" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <h3>Top hotels</h3>
                    <p>Handpicked accommodations for every budget.</p>
                </div>
            </div>
            <div class="card card-hover">
                <div class="card-body">
                    <i class="fa-solid fa-umbrella-beach" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <h3>Combo packages</h3>
                    <p>Flight + hotel bundles for extra savings.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-gap section-gap-light">
    <div class="container">
        <h2 class="section-title">Popular destinations</h2>
        <div class="destination-carousel" id="destinationsCarousel">
            @php
                $destinations = [
                    ['name' => 'Kuala Lumpur', 'image' => 'https://images.unsplash.com/photo-1597652878619-85a46bb0f8cb?w=300', 'link' => route('flights.search') . '?to=KUL'],
                    ['name' => 'Bangkok', 'image' => 'https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=300', 'link' => route('flights.search') . '?to=BKK'],
                    ['name' => 'Tokyo', 'image' => 'https://images.unsplash.com/photo-1536098561742-ca998e48cbcc?w=300', 'link' => route('flights.search') . '?to=NRT'],
                    ['name' => 'Paris', 'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=300', 'link' => route('flights.search') . '?to=CDG'],
                    ['name' => 'Singapore', 'image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?w=300', 'link' => route('flights.search') . '?to=SIN'],
                ];
            @endphp
            @foreach($destinations as $dest)
                <div class="carousel-item">
                    <a href="{{ $dest['link'] }}">
                        <div class="carousel-card card-hover">
                            <div class="carousel-card__image" style="background-image: url('{{ $dest['image'] }}'); background-size: cover; height: 160px;"></div>
                            <div class="carousel-card__body">
                                <strong>{{ $dest['name'] }}</strong>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .hero {
        padding: 80px 0;
    }
    .hero-grid {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 48px;
        align-items: center;
    }
    .hero-title {
        font-size: clamp(2.75rem, 6vw, 4rem);
        line-height: 1.05;
        margin-bottom: 1.25rem;
    }
    .hero-text {
        font-size: 1.05rem;
        color: #4b5563;
        margin-bottom: 2rem;
        max-width: 520px;
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
    .destination-carousel {
        overflow-x: auto;
        white-space: nowrap;
        scroll-behavior: smooth;
        padding-bottom: 8px;
        display: flex;
        gap: 18px;
    }
    .destination-carousel::-webkit-scrollbar {
        display: none;
    }
    .carousel-item {
        display: inline-block;
        width: 210px;
        flex-shrink: 0;
    }
    .carousel-card {
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: white;
    }
    .carousel-card__image {
        height: 160px;
        background-size: cover;
        background-position: center;
    }
    .carousel-card__body {
        padding: 1rem;
        text-align: center;
    }
    @media (max-width: 900px) {
        .hero-grid {
            grid-template-columns: 1fr;
        }
        .hero-image {
            min-height: 320px;
        }
    }
</style>
@endsection