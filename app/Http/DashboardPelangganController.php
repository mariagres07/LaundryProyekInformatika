<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPelangganController extends Controller
{
    public function tampilanPelanggan()
    {
        // menuju file: resources/views/pelanggan/beranda.blade.php
        return view('pelanggan.beranda');
    }
}
