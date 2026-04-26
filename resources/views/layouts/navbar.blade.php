<nav style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">

    <div class="logo">
        <a href="{{ route('home') }}">Travelio</a>
    </div>

    <div style="display:flex; gap:1.5rem; align-items:center;">

        @auth

            @if(auth()->user()->role == 'admin')

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.flights') }}">Flights</a>
            <a href="{{ route('admin.hotels') }}">Hotels</a>
            <a href="{{ route('admin.bookings') }}">Bookings</a>
            <a href="{{ route('admin.users') }}">Users</a>

            @else

                <a href="{{ route('flights.search') }}">Flights</a>
                <a href="{{ route('combo.index') }}">Flight+Hotel</a>
                <a href="{{ route('hotels.index') }}">Hotels</a>
                <a href="{{ route('my-bookings') }}">My Bookings</a>
                <a href="{{ route('profile') }}">Profile</a>

            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>

        @else

            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Sign Up</a>

        @endauth

    </div>

</nav>