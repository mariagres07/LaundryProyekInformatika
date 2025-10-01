<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class ClihatPesanan extends Controller
{
    public function index()
    {
        // Ambil data pesanan + relasi pelanggan
        $pesanan = Pesanan::with('pelanggan')
                    ->orderBy('tanggalMasuk', 'desc')
                    ->get();

        return view('lihatDataPesanan.lihatDPesanan', compact('pesanan'));
    }
}