@extends('app')

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
</style>

{{-- Payment Section --}}
<section style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 700; margin: 0 0 8px; color: #111827;">Review Your Booking</h1>
        <p style="color: #6b7280; margin: 0 0 40px; font-size: 1rem;">Confirm details before payment</p>

        @if(session('booking'))
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">
                <!-- Left: Order Summary -->
                <div class="card">
                    @if(session('booking.image_url'))
                        <div style="width: 100%; height: 260px; background-image: url('{{ session('booking.image_url') }}'); background-size: cover; background-position: center;"></div>
                    @endif
                    <div style="padding: 24px;">
                        <h3 style="margin: 0 0 8px; font-size: 1.4rem; color: #111827; font-weight: 700;">{{ session('booking.attraction_name') }}</h3>
                        <p style="margin: 0 0 24px; color: #6b7280; font-size: 0.95rem;">{{ session('booking.destination_name') }}</p>
                        
                        <div style="background: #f8fafc; border: 1px solid #d1d5db; border-radius: 12px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 0.9rem;">
                                <span style="color: #6b7280;">Price per ticket</span>
                                <span style="color: #111827; font-weight: 600;">RM {{ number_format(session('booking.price_per_person'), 2) }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 0.9rem;">
                                <span style="color: #6b7280;">Quantity</span>
                                <span style="color: #111827; font-weight: 600;">{{ session('booking.number_of_people') }}</span>
                            </div>
                            <div style="height: 1px; background: #d1d5db; margin: 12px 0;"></div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #111827; font-weight: 600;">Total</span>
                                <span style="font-size: 1.3rem; font-weight: 700; color: #111827;">RM {{ number_format(session('booking.total_price'), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Payment Info -->
                <div>
                    <div class="card" style="padding: 24px; margin-bottom: 20px;">
                        <h3 style="margin: 0 0 20px; font-size: 1.1rem; color: #111827; font-weight: 700;">Payment Method</h3>
                        
                        <!-- Placeholder -->
                        <div style="background: #f8fafc; border: 2px dashed #d1d5db; border-radius: 12px; padding: 40px 20px; text-align: center; margin-bottom: 24px;">
                            <div style="font-size: 2.5rem; margin-bottom: 12px;">💳</div>
                            <p style="margin: 0 0 4px; color: #111827; font-weight: 600;">Payment Gateway</p>
                            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">Ready for integration</p>
                        </div>

                        <!-- Button -->
                        <button type="button" onclick="alert('Payment integration coming soon!')" class="button button-primary" style="width: 100%; padding: 14px; margin-bottom: 12px;">
                            Proceed to Payment
                        </button>
                        <a href="{{ route('home') }}" class="button button-secondary" style="width: 100%; padding: 14px; text-align: center;">
                            Back to Home
                        </a>
                    </div>

                    <!-- Security Info -->
                    <div style="background: #f8fafc; border-left: 4px solid #111827; border-radius: 8px; padding: 16px;">
                        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">
                            <strong style="color: #111827;">🔒 Secure Payment</strong><br>
                            Your payment information is encrypted and secure.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="card" style="padding: 40px; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 12px;">⚠️</div>
                <h2 style="margin: 0 0 8px; font-size: 1.3rem; color: #111827; font-weight: 700;">No Booking Found</h2>
                <p style="margin: 0 0 24px; color: #6b7280; font-size: 0.95rem;">Your booking session has expired. Please start again.</p>
                <a href="{{ route('home') }}" class="button button-primary">Back to Attractions</a>
            </div>
        @endif
    </div>
</section>

@endsection

