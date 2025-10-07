<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardKaryawanController extends Controller
{
    public function tampilanKaryawan(Request $request)
    {
        return view('Dashboard.tampilanKaryawan');
    }
}
