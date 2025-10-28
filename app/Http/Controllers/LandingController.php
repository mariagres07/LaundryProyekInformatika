<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Tampilkan halaman utama (landing page).
     */
    public function index()
    {
        return view('login.index'); 
        // Pastikan view-nya disimpan di resources/views/landing/index.blade.php
    }
}
