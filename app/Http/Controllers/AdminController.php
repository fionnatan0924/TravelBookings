<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\ComboBooking;
use App\Models\Booking;
use App\Models\HotelBooking;
use App\Models\AttractionBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    // Dashboard
    public function dashboard()
{
    $totalUsers = User::count();
    $totalFlights = Flight::count();
    $totalHotels = Hotel::count();
    $totalBookings = Booking::count() + HotelBooking::count() + ComboBooking::count() + AttractionBooking::count();
    $recentBookings = collect()
        ->concat(Booking::with('user')->latest()->take(5)->get())
        ->concat(HotelBooking::with('user')->latest()->take(5)->get())
        ->concat(ComboBooking::with('user')->latest()->take(5)->get())
        ->concat(AttractionBooking::with('user')->latest()->take(5)->get())
        ->sortByDesc('created_at')
        ->take(5);

    return view('admin.dashboard', compact('totalUsers', 'totalFlights', 'totalHotels', 'totalBookings', 'recentBookings'));
}

    // ==================== USER MANAGEMENT ====================
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);
        return redirect()->route('admin.users')->with('success', 'User created.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);
        $user->update($validated);
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('admin.users')->with('success', 'User updated.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    // ==================== FLIGHT MANAGEMENT ====================
    public function flights()
    {
        $flights = Flight::latest()->paginate(15);
        return view('admin.flights.index', compact('flights'));
    }

    public function storeFlight(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string|max:10',
            'destination' => 'required|string|max:10|different:origin',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'airline' => 'required|string|max:100',
            'cabin_class' => 'required|in:economy,premium,business,first',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
            'duration' => 'nullable|string',
            'origin_terminal' => 'nullable|string',
            'destination_terminal' => 'nullable|string',
            'baggage' => 'nullable|string',
        ]);
        Flight::create($validated);
        return redirect()->route('admin.flights')->with('success', 'Flight created.');
    }

    public function editFlight(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function updateFlight(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'origin' => 'required|string|max:10',
            'destination' => 'required|string|max:10|different:origin',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'airline' => 'required|string|max:100',
            'cabin_class' => 'required|in:economy,premium,business,first',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
            'duration' => 'nullable|string',
            'origin_terminal' => 'nullable|string',
            'destination_terminal' => 'nullable|string',
            'baggage' => 'nullable|string',
        ]);
        $flight->update($validated);
        return redirect()->route('admin.flights')->with('success', 'Flight updated.');
    }

    public function deleteFlight(Flight $flight)
    {
        $flight->delete();
        return back()->with('success', 'Flight deleted.');
    }

    // ==================== HOTEL MANAGEMENT ====================
    public function hotels()
    {
        $hotels = Hotel::latest()->paginate(15);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function createHotel()
    {
        return view('admin.hotels.create');
    }

    public function storeHotel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'stars' => 'required|integer|min:1|max:5',
            'image' => 'nullable|url',
            'description' => 'nullable|string',
            'gallery' => 'nullable|json',
            'amenities' => 'nullable|string',
            'check_in_time' => 'nullable|string',
            'check_out_time' => 'nullable|string',
        ]);
        Hotel::create($validated);
        return redirect()->route('admin.hotels')->with('success', 'Hotel created.');
    }

    public function editHotel(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function updateHotel(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'stars' => 'required|integer|min:1|max:5',
            'image' => 'nullable|url',
            'description' => 'nullable|string',
            'gallery' => 'nullable|json',
            'amenities' => 'nullable|string',
            'check_in_time' => 'nullable|string',
            'check_out_time' => 'nullable|string',
        ]);
        $hotel->update($validated);
        return redirect()->route('admin.hotels')->with('success', 'Hotel updated.');
    }

    public function deleteHotel(Hotel $hotel)
    {
        $hotel->delete();
        return back()->with('success', 'Hotel deleted.');
    }

    // ==================== BOOKINGS OVERVIEW ====================
    public function allBookings()
    {
        $flightBookings = Booking::with('user', 'outboundFlight')->latest()->get();
        $hotelBookings = HotelBooking::with('user', 'hotel')->latest()->get();
        $comboBookings = ComboBooking::with('user', 'flight', 'hotel')->latest()->get();
        $attractionBookings = AttractionBooking::with('user', 'attraction')->latest()->get();

        return view('admin.bookings.index', compact('flightBookings', 'hotelBookings', 'comboBookings', 'attractionBookings'));
    }
}