<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|size:9',
        ]);

        // Check if a user with the provided email already exists
        $existingUser = User::where('email', $request->email)->exists();
        if ($existingUser) {
            return redirect()->back()->withInput()->withErrors(['email' => 'The provided email is already registered.']);
        }

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();

        // Redirect to the login page
        return redirect()->route('login')->with('success', 'Registration successful. Please Log In.');
    }
}