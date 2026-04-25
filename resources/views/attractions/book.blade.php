@extends('layouts.app')

@section('content')
<style>
    .card {
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        border-radius: 14px;
        overflow: hidden;
        background: white;
    }

    .button {
        padding: 12px 24px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 0.95rem;
    }

    .button-primary {
        background: #111827;
        color: #ffffff;
    }

    .button-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .button-secondary {
        background: #f8fafc;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    .button-secondary:hover {
        background: #f3f4f6;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #d1d5db;
        background: white;
        border-radius: 8px;
        font-size: 1.2rem;
        cursor: pointer;
        font-weight: 600;
        color: #111827;
        transition: all 0.3s;
    }

    .quantity-btn:hover {
        border-color: #111827;
        background: #f8fafc;
    }
</style>

{{-- Booking Section --}}
<section style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 700; margin: 0 0 8px; color: #111827;">Book Tickets</h1>
        <p style="color: #6b7280; margin: 0 0 40px; font-size: 1rem;">{{ $attraction->destination->name }}</p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: start;">
            <!-- Left: Attraction Card -->
            <div class="card">
                <div style="width: 100%; height: 260px; background-image: url('{{ $attraction->image_url ?? 'https://via.placeholder.com/500x300' }}'); background-size: cover; background-position: center;"></div>
                <div style="padding: 24px;">
                    <h2 style="margin: 0 0 12px; font-size: 1.5rem; color: #111827; font-weight: 700;">{{ $attraction->name }}</h2>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <span style="color: #f59e0b; font-size: 0.95rem;">★ {{ number_format($attraction->rating, 1) }}</span>
                        <span style="color: #6b7280; font-size: 0.9rem;">({{ number_format($attraction->reviews) }} reviews)</span>
                    </div>
                    
                    @if($attraction->description)
                        <p style="color: #6b7280; font-size: 0.95rem; line-height: 1.6; margin: 0 0 16px;">{{ $attraction->description }}</p>
                    @else
                        <p style="color: #6b7280; font-size: 0.95rem; line-height: 1.6; margin: 0 0 16px;">Enjoy an exciting local experience at {{ $attraction->name }} in {{ $attraction->destination->name }} with flexible ticketing and curated travel support.</p>
                    @endif
                    
                    @if($attraction->original_price)
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                            <span style="color: #6b7280; text-decoration: line-through; font-size: 0.9rem;">RM {{ number_format($attraction->original_price, 2) }}</span>
                            <span style="background: #ef4444; color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">{{ $attraction->discount_text }}</span>
                        </div>
                    @endif
                    
                    <div style="font-size: 1.75rem; font-weight: 700; color: #111827; margin: 16px 0 12px;">RM {{ number_format($attraction->price, 2) }} <span style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">/person</span></div>
                    @if($attraction->booking_text)
                        <p style="margin: 0; color: #059669; font-weight: 600; font-size: 0.9rem;">✓ {{ $attraction->booking_text }}</p>
                    @endif
                </div>
            </div>

            <!-- Right: Booking Form -->
            <div>
                <form action="{{ route('attraction.book.form') }}" method="POST">
                    @csrf
                    <input type="hidden" name="attraction_id" value="{{ $attraction->id }}">

                    <!-- Number Selection -->
                    <div style="margin-bottom: 28px;">
                        <label style="display: block; font-weight: 600; color: #111827; margin-bottom: 12px; font-size: 0.95rem;">How many tickets?</label>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <button type="button" class="quantity-btn" data-action="decrease">−</button>
                            <input type="number" name="number_of_people" id="number_of_people" value="1" min="1" max="50" style="width: 70px; height: 40px; border: 1px solid #d1d5db; border-radius: 8px; text-align: center; font-size: 1rem; font-weight: 600; color: #111827; background: #f8fafc;" readonly>
                            <button type="button" class="quantity-btn" data-action="increase">+</button>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div style="background: #f8fafc; border: 1px solid #d1d5db; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 0.9rem;">
                            <span style="color: #6b7280;">Price per ticket</span>
                            <span style="color: #111827; font-weight: 600;">RM {{ number_format($attraction->price, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 0.9rem;">
                            <span style="color: #6b7280;">Quantity</span>
                            <span style="color: #111827; font-weight: 600;" id="display-people">1</span>
                        </div>
                        <div style="height: 1px; background: #d1d5db; margin: 12px 0;"></div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #111827; font-weight: 600;">Total</span>
                            <span style="font-size: 1.3rem; font-weight: 700; color: #111827;" id="total-price">RM {{ number_format($attraction->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="button button-primary" style="width: 100%; padding: 14px; margin-bottom: 12px;">
                        Proceed to Payment
                    </button>
                    <button type="button" onclick="history.back()" class="button button-secondary" style="width: 100%; padding: 14px;">
                        Back
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const input = document.getElementById('number_of_people');
    const displayPeople = document.getElementById('display-people');
    const totalPriceSpan = document.getElementById('total-price');
    const pricePerPerson = {{ $attraction->price }};

    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.dataset.action;
            let current = parseInt(input.value);

            if (action === 'increase' && current < 50) {
                input.value = current + 1;
            } else if (action === 'decrease' && current > 1) {
                input.value = current - 1;
            }
            updateDisplay();
        });
    });

    input.addEventListener('change', updateDisplay);

    function updateDisplay() {
        const people = parseInt(input.value) || 1;
        displayPeople.textContent = people;
        totalPriceSpan.textContent = 'RM ' + (pricePerPerson * people).toFixed(2);
    }
</script>
@endsection