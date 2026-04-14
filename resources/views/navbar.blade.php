<nav style="background: #ffffff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 100;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; height: 76px; gap: 24px;">
        <a href="{{ route('home') }}" style="font-size: 20px; font-weight: 700; letter-spacing: -0.02em; color: #111827;">
            Travelio
        </a>
        <div style="display: flex; gap: 28px; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('destinations.index') }}" style="color: #4b5563; font-size: 15px;">Destinations</a>
            <a href="{{ route('combos.index') }}" style="color: #4b5563; font-size: 15px;">Combos</a>
            <a href="{{ url('/flights') }}" style="color: #4b5563; font-size: 15px;">Flights</a>
            <a href="{{ route('attractions.index') }}" style="color: #111827; font-size: 15px; font-weight: 600;">Attractions</a>
        </div>
        <div style="display: flex; gap: 14px; flex-wrap: wrap;">
            <a href="#" class="button button-muted" style="padding: 10px 18px; font-size: 14px;">Log in</a>
            <a href="#" class="button button-primary" style="padding: 10px 18px; font-size: 14px;">Sign up</a>
        </div>
    </div>
</nav>