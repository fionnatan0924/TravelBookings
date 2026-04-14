<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Travelio - @yield('title', 'Flight & Hotel Booking')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #f5f7fc 0%, #eef2f8 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo a {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0f2b3d, #1e6a8f);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: opacity 0.2s;
        }
        .logo a:hover { opacity: 0.85; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #2c5a7a;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .nav-links a:hover {
            color: #1e3a5f;
            transform: translateY(-1px);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f0f4fa;
            padding: 0.3rem 1rem;
            border-radius: 40px;
        }
        .user-name {
            font-weight: 600;
            color: #1e2f3e;
            font-size: 0.9rem;
        }
        .logout-btn {
            background: none;
            border: none;
            color: #e53e3e;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: 0.2s;
        }
        .logout-btn:hover { color: #b91c1c; }

        /* ===== MAIN CONTAINER ===== */
        .container {
            flex: 1;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            width: 100%;
        }

        /* ===== FLASH MESSAGES ===== */
        .alert {
            padding: 1rem 1.2rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== FOOTER ===== */
        footer {
            text-align: center;
            padding: 1.5rem;
            color: #6c7e94;
            font-size: 0.8rem;
            background: white;
            margin-top: 2rem;
            border-top: 1px solid #eef2f8;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar { flex-direction: column; padding: 1rem; }
            .nav-links { justify-content: center; }
            .container { margin: 1rem auto; }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <a href="{{ url('/') }}"><i class="fa-solid fa-plane-departure"></i> Travelio</a>
    </div>
    <div class="nav-links">
        <a href="{{ route('flights.search') }}"><i class="fa-solid fa-magnifying-glass"></i> Flights</a>
        <a href="{{ route('combo.index') }}"><i class="fa-solid fa-hotel"></i> Flight+Hotel</a>
        @auth
            <a href="{{ route('booking.index') }}"><i class="fa-solid fa-ticket"></i> My Bookings</a>
            <a href="{{ route('combo.my-bookings') }}"><i class="fa-solid fa-box"></i> My Combos</a>
            <a href="{{ route('hotels.index') }}"><i class="fa-solid fa-hotel"></i> Hotels</a>
            <div class="user-info">
                <span class="user-name"><i class="fa-regular fa-user"></i> {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}"><i class="fa-solid fa-key"></i> Login</a>
            <a href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
        @endauth
    </div>
</nav>

<main class="container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-regular fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} Travelio – Smart Flight & Hotel Booking. All rights reserved.</p>
</footer>

@stack('scripts')
</body>
</html>