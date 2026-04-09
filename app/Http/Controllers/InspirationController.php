<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspirationController extends Controller
{
    /**
     * Display the wedding inspiration page.
     */
    public function index()
    {
        // For now, return a placeholder view
        return view('pages.inspiration');
    }
}