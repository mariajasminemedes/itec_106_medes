<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
        public function showRegister()
    {
        return view('register'); // Looks for resources/views/register.blade.php
    }
    public function register(Request $request)
{
    // Validate the input data fields
    $request->validate([
        'username' => ['required', 'string', 'max:50', 'unique:users,username'],
        'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
        'password' => ['required', 'string', 'min:6', 'confirmed'], // requires a password_confirmation field
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string'],
        'gender' => ['nullable', 'in:Male,Female,Other'],
        'date_of_birth' => ['nullable', 'date'],
    ]);

    // Create and save the new user record into your database
    $user = \App\Models\User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => \Hash::make($request->password), // Automatically encrypts the password securely
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'profile_picture' => 'default-avatar.png', // Fallback default image from your schema
    ]);

    // Automatically log the new user in
    Auth::login($user);

    // Redirect to the dashboard with a success toast message
    return redirect()->route('dashboard')
        ->with('toast_message', 'Account created successfully! Welcome, ' . $user->username . '!')
        ->with('toast_type', 'success');
}
    // 1. Show the Login Form
    public function showLogin()
    {
        return view('login'); // Looks for resources/views/login.blade.php
    }

    // 2. Process the Login Form submission
    public function login(Request $request)
    {
        // Laravel's built-in validation rules
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in using Laravel's internal Auth system
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect with success toast message
            return redirect()->intended('dashboard')
                ->with('toast_message', 'Welcome back, ' . Auth::user()->username . '!')
                ->with('toast_type', 'success');
        }

        // If authentication fails
        return back()->with([
            'toast_message' => 'Invalid username or password!',
            'toast_type' => 'error'
        ]);
        
    }
}