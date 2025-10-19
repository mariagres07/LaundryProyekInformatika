<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesanLaundryController extends Controller
{
    public function index()
    {
        return view('PesananLaundryPengguna.PesanLaundry');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'paket'  => 'required',
            'pakaian' => 'nullable|integer|min:0',
            'seprai'  => 'nullable|integer|min:0',
            'handuk'  => 'nullable|integer|min:0',
        ]);

        // Ambil data pelanggan dari session
        $user = session('user');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login sebagai pelanggan terlebih dahulu.']);
        }

        // Hitung estimasi berdasarkan paket
        $estimasi = str_contains(strtolower($request->paket), 'express') ? '1 Hari' : '3 Hari';

        // Daftar harga
        $hargaPerKategori = [
            'pakaian' => 5000,
            'seprai'  => 10000,
            'handuk'  => 7000,
        ];

        // Hitung total harga
        $total = 0;
        $beratBarang = 0;
        foreach ($hargaPerKategori as $key => $harga) {
            $jumlah = (int) $request->input($key, 0);
            $total += $jumlah * $harga;
            $beratBarang += $jumlah;
        }

        // Tambahkan biaya paket
        $biayaPaket = str_contains(strtolower($request->paket), 'express') ? 15000 : 10000;
        $total += $biayaPaket;

        // Simpan pesanan ke database
        Pesanan::create([
            'namaPesanan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => 1,
            'idKurir'        => null,
            'idKaryawan'     => null,
            'statusPesanan'  => false,
            'beratBarang'    => $beratBarang,
            'tanggalMasuk'   => now(),
            'tanggalSelesai' => now()->addDays($estimasi),
            'totalHarga'     => $total,
        ]);

        return redirect()->route('detailPesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function detail()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login dulu.']);
        }

        $pesanan = Pesanan::where('idPelanggan', $user['idPelanggan'])->latest('idPesanan')->first();

        if (!$pesanan) {
            return redirect()->route('pesanLaundry')
                ->with('error', 'Belum ada pesanan.');
        }

        return view('PesananLaundryPengguna.detailPesanan', compact('pesanan'));
    }
}
