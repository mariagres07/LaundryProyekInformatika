<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cdashboard extends Controller
{
    public function tampilanKaryawan(Request $request)
    {
        return view('Dashboard.tampilanKaryawan');
    }
    
    public function tampilanKurir(Request $request)
    {
        return view('Dashboard.tampilanKurir');
    }
}