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
                    ->whereNull('beratBarang')
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

    public function perhitungan(Request $request, $id)
{
    $pesanan = Pesanan::with('detailTransaksi.kategoriItem')->findOrFail($id);

    // Simpan berat barang yang diinputkan user
    $pesanan->beratBarang = $request->beratBarang;

    $totalHarga = 0;

    foreach ($pesanan->detailTransaksi as $detail) {
        $kategori = $detail->kategoriItem->namaKategori;
        $jumlah = $detail->jumlahKategori;

        if ($kategori == 'Pakaian') {
            $totalHarga += $pesanan->beratBarang * 7000;
        } elseif ($kategori == 'Handuk') {
            $totalHarga += $jumlah * 5000;
        } elseif (in_array($kategori, ['Seprai', 'Selimut', 'Bed cover'])) {
            $totalHarga += $jumlah * 10000;
        }
    }

    $pesanan->totalHarga = $totalHarga;
    $pesanan->save();

    return redirect()->back()->with('success', 'Verifikasi berhasil! Total harga telah dihitung.');
}

}