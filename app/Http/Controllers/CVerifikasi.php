<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class CVerifikasi extends Controller
{
    public function index()
    {
        // Ambil data pesanan + relasi pelanggan
        $pesanan = Pesanan::with('pelanggan')
                    ->orderBy('tanggalMasuk', 'desc')
                    ->get();

        return view('VerifikasiP.LihatVerifikasi', compact('pesanan'));
    }
    public function detail($id)
    {
        // Ambil data pesanan dengan relasi yang diperlukan
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);


        return view('VerifikasiP.DetailVerifikasi', compact('pesanan'));
    }
}