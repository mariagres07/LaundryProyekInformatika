<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;
use App\Models\DetailTransaksi;
use App\Models\TransaksiPembayaran;

class PembayaranController extends Controller
{
    // Halaman pembayaran
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

        // Cek apakah pesanan sudah diverifikasi
        if (is_null($pesanan->beratBarang)) {
            return redirect()->route('pesanLaundry.index')
                ->with('error', 'Pesanan belum diverifikasi oleh kurir. Silakan tunggu penimbangan selesai.');
        }

        $layanan = Layanan::find($pesanan->idLayanan);
        $totalHarga = $pesanan->totalHarga;

        // Ambil detail transaksi
        $detail = DetailTransaksi::where('idPesanan', $pesanan->idPesanan)->first();

        // Ambil transaksi pembayaran jika ada
        $transaksiPembayaran = TransaksiPembayaran::where('idDetailTransaksi', $detail->idDetailTransaksi)->first();

        // Jika belum ada transaksi pembayaran, buat record baru dengan kode
        if (!$transaksiPembayaran) {
            $kodePembayaran = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $transaksiPembayaran = TransaksiPembayaran::create([
                'idDetailTransaksi' => $detail->idDetailTransaksi,
                'kodePembayaran' => $kodePembayaran,
                'tanggalPembayaran' => null, // Belum dibayar
                'totalPembayaran' => $totalHarga,
                'buktiPembayaran' => null,
            ]);
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

    // Proses konfirmasi pembayaran dan upload bukti
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

        // Validasi upload bukti pembayaran
        $request->validate([
            'buktiPembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file bukti pembayaran
        $path = $request->file('buktiPembayaran')->store('bukti', 'public');

        // Ambil detail transaksi terkait pesanan
        $detail = DetailTransaksi::where('idPesanan', $idPesanan)->first();

        // Ambil transaksi pembayaran yang sudah dibuat di index
        $transaksiPembayaran = TransaksiPembayaran::where('idDetailTransaksi', $detail->idDetailTransaksi)->first();

        // Update transaksi pembayaran: simpan bukti dan set tanggal pembayaran
        $transaksiPembayaran->update([
            'buktiPembayaran' => $path,
            'tanggalPembayaran' => now(),
        ]);

        // Tetap di halaman pembayaran dengan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran berhasil dilakukan.');
    }
}