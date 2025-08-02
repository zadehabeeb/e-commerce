<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AdminController;

class AdminLoginController extends Controller
{
    // Display the admin login page
    public function create()
    {
        return view('backend.admin-login'); // This will now load resources/views/backend/admin-login.blade.php
    }

    // Handle admin login attempt
    public function store(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the admin
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Regenerate session to avoid session fixation
            $request->session()->regenerate();

            // Check if the authenticated user has the 'admin' role
            if (Auth::user()->hasRole('admin')) {
                // Redirect to the admin dashboard after successful login
                return redirect()->route('backend.dashboard'); // Change this line
            }

            // If the user is not an admin, log them out and show an error message
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'You are not an admin.']);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);




        

    }
           public function logout(Request $request)
        {
             Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                 return redirect()->route('admin.login');
        }
}


