<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. Show the Profile Form with current user data
    public function edit()
    {
        // Fetch the currently logged-in user
        $user = Auth::user(); 
        return view('profile', compact('user')); // Looks for resources/views/profile.blade.php
    }

    // 2. Handle updating the text records and uploading the profile picture
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate form inputs
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'in:Male,Female,Other'],
            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] // Max 2MB file
        ]);

        // Process profile picture file upload if present
        if ($request->hasFile('profile_picture')) {
            // Securely generate name and store in storage/app/public/uploads
            $file = $request->file('profile_picture');
            $newFilename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $newFilename, 'public');

            // Delete old profile picture if it's not the default avatar system placeholder
            if ($user->profile_picture !== 'default-avatar.png' && $user->profile_picture) {
                Storage::disk('public')->delete('uploads/' . $user->profile_picture);
            }

            // Set new filename attribute
            $user->profile_picture = $newFilename;
        }

        // Update the user details fields
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        
        $user->save();

        // Redirect back with toast notification
        return redirect()->route('profile.edit')
            ->with('toast_message', 'Profile updated successfully!')
            ->with('toast_type', 'success');
    }
}