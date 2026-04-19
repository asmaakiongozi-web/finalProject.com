<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show user dashboard
    public function userDashboard()
    {
        return view('profile.dashboard'); // blade yako ipo resources/views/profile/dashboard.blade.php
    }

    // Example: user resources page
    public function resources()
    {
        return view('profile.resources'); // create resources.blade.php
    }
}