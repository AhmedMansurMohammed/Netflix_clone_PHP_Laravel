<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    //
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('forgotPassword.submit')->withErrors($validator)->withInput();
        }

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('forgot.password')->with('error', 'User not found.');
        }

        //Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password updated successfully. You can now login with your new password.');
    }
}
