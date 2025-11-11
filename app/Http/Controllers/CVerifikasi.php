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
        // $pesanan = Pesanan::with('detailTransaksi.kategoriItem')->findOrFail($id);

        // Simpan berat barang yang diinputkan user
        // $pesanan->beratBarang = $request->beratBarang;

        // $totalHarga = 0;

        // foreach ($pesanan->detailTransaksi as $detail) {
        //     $kategori = $detail->kategoriItem->namaKategori;
        //     $jumlah = $detail->jumlahItem;

        //     if ($kategori == 'Pakaian') {
        //         $totalHarga += $pesanan->beratBarang * $kategori->hargaKategori;
        //     } 
        //     else {
        //         $totalHarga += $jumlah * $kategori->hargaKategori;
        //     }
        // }
        // Update total harga dan status pesanan
        //     $pesanan->update([
        //         'totalHarga'    => $totalHarga,
        //         'statusPesanan' => 'Menunggu Pembayaran', // update status setelah konfirmasi
        //     ]);

        //     return redirect()->back()->with('success', 'Verifikasi pemesanan berhasil dilakukan.');
        // }

        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);

        // Simpan berat barang yang diinputkan user
        $pesanan->beratBarang = $request->beratBarang;

        // Update status pesanan (tanpa menghitung total harga)
        $pesanan->statusPesanan = 'Menunggu Pembayaran';

        // Simpan perubahan
        $pesanan->save();

        return redirect()->back()->with('success', 'Verifikasi pemesanan berhasil dilakukan.');
    }
}
