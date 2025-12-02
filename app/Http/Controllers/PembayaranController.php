<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;
use App\Models\DetailTransaksi;
use App\Models\TransaksiPembayaran;

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

        // Cek apakah pesanan sudah diverifikasi (sudah ada beratBarang)
        if (is_null($pesanan->beratBarang) || $pesanan->beratBarang == 0) {
            return redirect()->back()
                ->with('error', 'Pesanan belum diverifikasi oleh kurir. Silakan tunggu penimbangan selesai.');
        }

        // Ambil total harga dari pesanan
        $totalHarga = $pesanan->totalHarga;

        if ($pesanan->beratBarang == null || $pesanan->beratBarang == 0) {
            return redirect()->back()->with('error', 'Tidak dapat ke pembayaran, pesanan belum diverifikasi oleh kurir.');
        }

        return view('Pembayaran.pembayaran', compact('pesanan'));

        // Ambil data layanan terkait untuk mendapatkan harga
        $layanan = Layanan::where('idLayanan', $pesanan->idLayanan)->first();

        // if (!$layanan) {
        //     return redirect()->route('pesanLaundry.index')
        //         ->with('error', 'Layanan terkait tidak ditemukan.');
        // }

        // Hitung total harga
        // $totalHarga =  $pesanan->beratBarang * $layanan->hargaPerKg;

        // $detail = DetailTransaksi::where('idPesanan', $pesanan->idPesanan)->first();

        // Jika belum ada detailTransaksi → otomatis buat
        // if (!$detail) {
        //     $detail = DetailTransaksi::create([
        //         'idPesanan' => $pesanan->idPesanan,
        //         'idKategoriItem' => 1, // Default kategori pakaian (sesuaikan dengan database)
        //         'jumlahKategori' => $pesanan->pakaian ?? 0,
        //     ]);
        // }

        // $pesanan->update([
        //     'totalHarga' => $totalHarga,
        // ]);

        // Generate kode pembayaran 6 digit
        $kodePembayaran = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Kirim data ke view
        return view('Pembayaran.pembayaran', compact('pesanan', 'layanan', 'totalHarga', 'kodePembayaran'));
    }

    public function prosesPembayaran(Request $request, $idPesanan)
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $pesanan = Pesanan::where('idPesanan', $idPesanan)
            ->where('idPelanggan', $user['idPelanggan'])
            ->first();

        if (!$pesanan) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        // Validasi upload bukti pembayaran
        $request->validate([
            'buktiPembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // SIMPAN FILE DULU (INI YANG KAMU LUPA)
        $path = $request->file('buktiPembayaran')->store('bukti', 'public');

        // Ambil detail transaksi terkait pesanan
        $detail = DetailTransaksi::where('idPesanan', $idPesanan)->first();

        if (!$detail) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Detail transaksi tidak ditemukan.');
        }

        $total = $pesanan->totalHarga;

        // Generate kode pembayaran 6 digit
        $kode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Buat transaksi pembayaran
        TransaksiPembayaran::create([
            'idDetailTransaksi' => $detail->idDetailTransaksi,
            // 'metodePembayaran' => 'Transfer',
            'tanggalPembayaran' => now(),
            'totalPembayaran' => $total,
            'buktiPembayaran' => $path,
            'kodePembayaran' => $kode,
        ]);

        // Update pesanan hanya status saja
        $pesanan->update([
            'statusPembayaran' => 'Lunas',
            'statusPesanan' => 'Menunggu Pengantaran'
        ]);

        return redirect()->route('pesanLaundry.index')
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}