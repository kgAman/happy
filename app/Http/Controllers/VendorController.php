<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display the vendors directory.
     */
    public function index()
    {
        // For now, return a placeholder view
        return view('pages.vendors');
    }
}