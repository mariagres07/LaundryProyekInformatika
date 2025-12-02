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
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil pesanan
        $pesanan = Pesanan::where('idPesanan', $idPesanan)
            ->where('idPelanggan', $user['idPelanggan'])
            ->first();

        if (!$pesanan) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        // Cek apakah pesanan sudah diverifikasi
        if (is_null($pesanan->beratBarang)) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Pesanan belum diverifikasi oleh kurir. Silakan tunggu penimbangan selesai.');
        }

        $layanan = Layanan::find($pesanan->idLayanan);
        $totalHarga = $pesanan->totalHarga;

        // CARI DETAIL TRANSAKSI TERLEBIH DAHULU
        $detail = DetailTransaksi::where('idPesanan', $pesanan->idPesanan)->first();

        // CARI TRANSAKSI PEMBAYARAN
        $transaksiPembayaran = transaksipembayaran::where('idDetailTransaksi', $detail->idDetailTransaksi)->first();

        // Jika belum ada → buat kode pembayaran sementara
        if (!$transaksiPembayaran) {
            $kodePembayaran = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } else {
            $kodePembayaran = $transaksiPembayaran->kodePembayaran;
        }

        return view('Pembayaran.pembayaran', compact(
            'pesanan',
            'layanan',
            'totalHarga',
            'transaksiPembayaran',
            'kodePembayaran'
        ));
    }

    // ===================== PROSES PEMBAYARAN (UPLOAD BUKTI) =====================
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