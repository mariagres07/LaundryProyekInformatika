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

    // Tambahkan method baru untuk lihat detail
    public function lihatDetail($id)
    {
        // Ambil data pesanan dengan relasi yang diperlukan
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);


        return view('lihatDataPesanan.lihatDetail', compact('pesanan'));
    }
}