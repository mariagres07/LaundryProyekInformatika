<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

// KURIR
class ClihatPesanan extends Controller
{
    public function index()
    {
        // Ambil hanya pesanan dengan status '0' (proses) + relasi pelanggan
        $pesanan = Pesanan::with('pelanggan')
            ->where('statusPesanan', 'Menunggu Penjemputan') // hanya status proses
            ->orderBy('tanggalMasuk', 'desc')
            ->get();

        return view('lihatDataPesanan.lihatDPesanan', compact('pesanan'));
    }

    // Method untuk lihat detail pesanan
    public function lihatDetail($id)
    {
        // Ambil data pesanan dengan relasi yang diperlukan
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);

        return view('lihatDataPesanan.lihatDetail', compact('pesanan'));
    }
}
