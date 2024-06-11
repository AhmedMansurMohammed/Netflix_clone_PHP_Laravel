<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            //clean session
            
            // Authentication successful
            $user = Auth::user();

            // Store user data in the session
           
            session([
                'id' => $user->id_user,
                'email' => $user->email,
                'phoneNumber' => $user->phone_number, // Assuming the phone number field is named 'phoneNumber'
                'name' => $user->name,
                'password' => $user->password,
                'role'=>$user->role,
            ]);
            return redirect()->route('home');
        } else {
            // Authentication failed
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
        // Save the username and password in session

    }

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('login');
    }
}
