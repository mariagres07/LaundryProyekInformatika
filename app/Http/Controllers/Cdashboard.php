<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cdashboard extends Controller
{
    public function tampilanKaryawan(Request $request)
    {
        $user = session('user');
        return view('Dashboard.tampilanKaryawan', compact('user'));
    }

    public function tampilanKurir(Request $request)
    {
        $user = session('user');
        return view('Dashboard.tampilanKurir', compact('user'));
    }

    public function tampilanPelanggan()
    {
        $user = session('user');
        return view('Dashboard.tampilanPelanggan', compact('user'));
    }
}
