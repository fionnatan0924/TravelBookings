@extends('layouts.app')

@section('title', 'Attraction Payment')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="payment-container">
    <div class="payment-card">
        <h1><i class="fa-regular fa-credit-card"></i> Attraction Payment</h1>
        <p>Complete your attraction booking</p>
        <div class="summary">
            <p><strong>Total:</strong> RM {{ number_format($total, 2) }}</p>
        </div>

        <form method="POST" action="{{ route('payment.attraction.process') }}">
            @csrf
            <div class="form-group">
                <label>Card Number</label>
                <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Expiry (MM/YY)</label>
                    <input type="text" name="expiry" id="expiry" placeholder="MM/YY" maxlength="5" required>
                </div>
                <div class="form-group">
                    <label>CVV</label>
                    <input type="text" name="cvv" id="cvv" placeholder="123" maxlength="3" required>
                </div>
            </div>
            <button type="submit" class="pay-btn">Pay Now <i class="fa-solid fa-lock"></i></button>
        </form>
        <p class="secure-note">* Test card: 4111111111111111, expiry 12/25, CVV 123</p>
    </div>
</div>

<style>
    .payment-container { max-width: 500px; margin: 0 auto; padding: 2rem; }
    .payment-card { background: white; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1); }
    .summary { background: #f8fafc; padding: 1rem; border-radius: 1rem; margin: 1rem 0; text-align: center; font-weight: 500; }
    .alert-danger { background: #f8d7da; color: #721c24; padding: 0.75rem; border-radius: 0.75rem; margin-bottom: 1rem; }
    .form-group { margin-bottom: 1rem; }
    .form-row { display: flex; gap: 1rem; }
    .form-row .form-group { flex: 1; }
    label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.3rem; color: #4a627a; }
    input { width: 100%; padding: 0.7rem; border: 1px solid #cbd5e1; border-radius: 12px; font-family: 'Inter', sans-serif; transition: 0.2s; }
    input:focus { border-color: #1f4b6e; outline: none; box-shadow: 0 0 0 3px rgba(31,75,110,0.1); }
    .pay-btn { width: 100%; background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; border: none; padding: 0.8rem; border-radius: 40px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.2s; }
    .pay-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,0.15); }
    .secure-note { font-size: 0.7rem; color: #6c7e94; text-align: center; margin-top: 1rem; }
</style>

<script>
    // Auto-format card number
    document.getElementById('card_number').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '').substring(0, 16);
        let formatted = value.replace(/(\d{4})(?=\d)/g, '$1 ');
        e.target.value = formatted;
    });
    // Auto-format expiry
    document.getElementById('expiry').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '').substring(0, 4);
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2);
        }
        e.target.value = value;
    });
    // CVV: only numbers
    document.getElementById('cvv').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
    });
</script>