<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;
use Midtrans\Snap;
use Midtrans\Config;

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
        // return view('PesananLaundryPengguna.Pembayaran', compact('pesanan', 'layanan', 'totalHarga'));

        // ========== Tambahkan konfigurasi Midtrans ==========
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->idPesanan,
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => $user['namaLengkap'] ?? 'Pelanggan',
                'email' => $user['email'] ?? 'user@example.com',
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Kirim ke view
        return view(
            'PesananLaundryPengguna.Pembayaran',
            compact('pesanan', 'layanan', 'totalHarga', 'snapToken')
        );
    }

    // ===================== PROSES PEMBAYARAN (UPLOAD BUKTI) =====================
    public function prosesPembayaran(Request $request, $idPesanan)
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pesanan = Pesanan::where('idPesanan', $idPesanan)
            ->where('idPelanggan', $user['idPelanggan'])
            ->first();

        if (!$pesanan) {
            return redirect()->route('pesanLaundry.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Validasi upload bukti pembayaran
        $validated = $request->validate([
            'buktiPembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan bukti pembayaran ke storage/app/public/bukti
        $path = $request->file('buktiPembayaran')->store('bukti', 'public');

        // Update status pesanan dan simpan path bukti
        $pesanan->buktiPembayaran = $path;
        $pesanan->statusPembayaran = 'Lunas';
        $pesanan->save();

        return redirect()->route('pesanLaundry.index')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function success()
    {
        return view('Pembayaran.PembayaranSukses');
    }
}
