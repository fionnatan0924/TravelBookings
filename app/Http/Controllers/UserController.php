<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show login form
    public function showLoginForm() {
        return view('login');
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
    public function signup(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // default role
        ]);

        Auth::login($user);
        return redirect('/');
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
}