<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Render the admin dashboard view
        return view('backend.dashboard'); // Make sure to create this view
    }
}
