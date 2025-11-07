<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;

class PembayaranController extends Controller
{
    public function index($idPesanan)
    {
        $user = session('pelanggan'); // Ambil data pelanggan dari session
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pesanan berdasarkan idPesanan
        $pesanan = Pesanan::where('idPesanan', $idPesanan)
            ->where('idPelanggan', $user['idPelanggan'])
            ->first();

        if (!$pesanan) {
            return redirect()->route('pesanLaundry.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Cek apakah pesanan sudah diverifikasi (sudah ada beratBarang)
        if (is_null($pesanan->beratBarang)) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Pesanan belum diverifikasi oleh kurir. Silakan tunggu penimbangan selesai.');
        }

        // Ambil data layanan terkait untuk mendapatkan harga
        $layanan = Layanan::where('idLayanan', $pesanan->idLayanan)->first();

        if (!$layanan) {
            return redirect()->route('pesanLaundry.index')->with('error', 'Layanan terkait tidak ditemukan.');
        }

        // Hitung total harga
        $totalHarga =  $pesanan->beratBarang * $layanan->hargaPerKg;

        // Kirim data ke view
        return view('PesananLaundryPengguna.Pembayaran', [
            'pelanggan' => $user,
            'pesanan' => $pesanan,
            'layanan' => $layanan,
            'totalHarga' => $totalHarga,
        ]);
    }
}
