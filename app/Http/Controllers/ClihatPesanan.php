<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Ambil data pesanan + relasi pelanggan
        $pesanan = Pesanan::with('pelanggan')
                    ->orderBy('tanggalMasuk', 'desc')
                    ->get();

        return view('pesanan.index', compact('pesanan'));
    }
}