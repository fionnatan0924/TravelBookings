<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();

       if ($user) {

    session(['user' => $user]);

    if ($user->role == 'admin') {
        return redirect('/admin/users');
    } else {
        return redirect('/profile'); 
    }

    } else {
        return back()->withErrors(['Invalid email or password']);
        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',

            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed'
            ],
        ], [

            'name.required' => 'Name is required.', //name

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.', //email

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number and symbol.',
            'password.confirmed' => 'Passwords do not match.', //password
        ]);

        // insert data
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ]);

        return redirect('/login')->with('success', 'Account created!');
    }

    public function manageUsers()
    {
    $users = DB::table('users')->get();

    return view('admin.users', compact('users'));
    }

    public function addUser(Request $request)
    {
    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role' => $request->role
    ]);

    return back()->with('success', 'User added!');
    }

    public function updateUser(Request $request, $id)
    {
    DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

    return back()->with('success', 'User updated!');
    }

    public function deleteUser($id)
    {
    DB::table('users')->where('id', $id)->delete();

    return back()->with('success', 'User deleted!');
    }

    public function updateProfile(Request $request)
    {
    DB::table('users')
        ->where('id', session('user')->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

    $user = DB::table('users')->where('id', session('user')->id)->first();
    session(['user' => $user]);

    return back()->with('success', 'Profile updated!');
    }
}