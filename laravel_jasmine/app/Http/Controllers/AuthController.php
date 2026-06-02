<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
        public function showRegister()
    {
        return view('register'); 
    }
    public function register(Request $request)
{
    
    $request->validate([
        'username' => ['required', 'string', 'max:50', 'unique:users,username'],
        'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
        'password' => ['required', 'string', 'min:6', 'confirmed'], 
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string'],
        'gender' => ['nullable', 'in:Male,Female,Other'],
        'date_of_birth' => ['nullable', 'date'],
    ]);

    $user = \App\Models\User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => \Hash::make($request->password), 
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'profile_picture' => 'default-avatar.png', 
    ]);

    return redirect()->route('login')
        ->with('toast_message', 'Account created successfully! Please log in, ' . $user->username . '.')
        ->with('toast_type', 'success');
}
    public function showLogin()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

          
            return redirect()->intended('dashboard')
                ->with('toast_message', 'Welcome back, ' . Auth::user()->username . '!')
                ->with('toast_type', 'success');
        }

        return back()->with([
            'toast_message' => 'Invalid username or password!',
            'toast_type' => 'error'
        ]);
        
    }
}