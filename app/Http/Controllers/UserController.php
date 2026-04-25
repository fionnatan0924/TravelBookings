<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Show login form
    public function showLoginForm() {
        return view('login');
    }

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password changed successfully.');
}

    // Handle login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            // Redirect based on role (optional)
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    // Show signup form
    public function showSignupForm() {
        return view('signup');
    }

    // Handle signup
    public function signup(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->mixedCase()      // requires at least one uppercase and one lowercase
                ->numbers()        // requires at least one number
                ->symbols(),       // requires at least one symbol
        ],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);
    return redirect()->route('home')->with('success', 'Account created successfully!');
}

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Profile update (optional)
    public function updateProfile(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
        ]);
        $user->update($validated);
        return back()->with('success', 'Profile updated.');
    }

    // Admin methods
    public function manageUsers() {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function addUser(Request $request) {
        // validation and create
    }

    public function updateUser(Request $request, $id) {
        // update logic
    }

    public function deleteUser($id) {
        User::destroy($id);
        return back();
    }

    public function profile()
{
    $user = Auth::user();
    return view('profile', compact('user'));
}

public function attractionBookings()
{
    return $this->hasMany(AttractionBooking::class);
}


public function myBookings()
{
    $user = Auth::user();

    $flightBookings = $user->bookings()->with('outboundFlight')->latest()->get();
    $comboBookings = $user->comboBookings()->with(['flight', 'hotel'])->latest()->get();
    $hotelBookings = $user->hotelBookings()->with('hotel')->latest()->get();
    $attractionBookings = $user->attractionBookings()->with('attraction.destination')->latest()->get();

    $allBookings = collect();

    foreach ($flightBookings as $booking) {
        $booking->type = 'flight';
        $booking->display_title = $booking->outboundFlight->origin . ' → ' . $booking->outboundFlight->destination;
        $booking->display_date = $booking->booking_date;
        $allBookings->push($booking);
    }

    foreach ($comboBookings as $booking) {
        $booking->type = 'combo';
        $booking->display_title = $booking->flight->origin . ' → ' . $booking->flight->destination . ' + ' . $booking->hotel->name;
        $booking->display_date = $booking->created_at;
        $allBookings->push($booking);
    }

    foreach ($hotelBookings as $booking) {
        $booking->type = 'hotel';
        $booking->display_title = $booking->hotel->name . ' (' . $booking->hotel->city . ')';
        $booking->display_date = $booking->created_at;
        $allBookings->push($booking);
    }

    // ADD attraction bookings to the collection
    foreach ($attractionBookings as $booking) {
        $booking->type = 'attraction';
        $booking->display_title = $booking->attraction->name . ' (' . $booking->attraction->destination->name . ')';
        $booking->display_date = $booking->booking_date;
        $allBookings->push($booking);
    }

    $allBookings = $allBookings->sortByDesc('display_date');

    return view('my-bookings', compact('allBookings'));
}
}