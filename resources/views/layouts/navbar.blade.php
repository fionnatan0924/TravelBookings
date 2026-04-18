<nav style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
    <div class="logo">
        <a href="{{ route('home') }}" style="font-size: 1.6rem; font-weight: 800; background: linear-gradient(135deg, #0f2b3d, #1e6a8f); background-clip: text; -webkit-background-clip: text; color: transparent;">
            Travelio
        </a>
    </div>
    <div style="display: flex; gap: 1.5rem; align-items: center;">
        <a href="{{ route('flights.search') }}">Flights</a>
        <a href="{{ route('combo.index') }}">Flight+Hotel</a>
        <a href="{{ route('hotels.index') }}">Hotels</a>
        @auth
            <a href="{{ route('my-bookings') }}">My Bookings</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #e53e3e; cursor: pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Sign Up</a>
        @endauth
    </div>
</nav>