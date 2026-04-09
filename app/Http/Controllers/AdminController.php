<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Profile; // If you have a profile model

class AdminController extends Controller
{
    public function index()
    {
        // In a real app, you would count actual database records here:
        // $totalUsers = User::count();
        // $totalProfiles = Profile::count();
        
        // Passing dummy data for now so you can see the layout
        $stats = [
            'total_users' => 150,
            'total_profiles' => 320,
            'new_profiles_today' => 12,
            'active_roles' => 4
        ];

        return view('admin.dashboard', compact('stats'));
    }
}