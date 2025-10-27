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
            'namaPesanan' => 'required',
            'idLayanan'  => 'required',
            'alamat'      => 'required',
            'paket'       => 'required',
        ]);

        // Ambil data pelanggan dari session
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login sebagai pelanggan terlebih dahulu.']);
        }


        $paket = strtolower($request->input('paket', 'reguler'));

        // Hitung estimasi berdasarkan paket
        $estimasiHari = str_contains($paket, 'express') ? 1 : 3;

        // // Daftar harga
        // $hargaPerKategori = [
        //     'pakaian' => 5000,
        //     'seprai'  => 10000,
        //     'handuk'  => 7000,
        // ];

        // // Hitung total harga
        // $total = 0;
        // // $beratBarang = 0;
        // foreach ($hargaPerKategori as $key => $harga) {
        //     $jumlah = (int) $request->input($key, 0) * $harga;
        //     $total += $jumlah;
        // }

        // // Tambahkan biaya paket
        // $biayaPaket = str_contains($paket, 'express') ? 15000 : 10000;
        // $total += $biayaPaket;

        // $beratBarang = (int)$request->pakaian + (int)$request->seprai + (int)$request->handuk;

        // Simpan pesanan ke database
        $pesanan = Pesanan::create([
            'namaPesanan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => $request->idLayanan,
            'idKurir'        => null,
            'idKaryawan'     => null,
            'statusPesanan'  => 'Menunggu Penjemputan',
            'alamat'         => $request->alamat,
            'paket'          => $request->paket,
            'pakaian'        => (int) $request->pakaian,
            'seprai'         => (int) $request->seprai,
            'handuk'         => (int) $request->handuk,
            'beratBarang'    => null,
            'tanggalMasuk'   => now(),
            'tanggalSelesai' => now()->addDays($estimasiHari),
            'totalHarga'     => null,
        ]);

        // return redirect()->route('detailPesanan')->with('success', 'Pesanan berhasil dibuat!');

        // Redirect ke halaman detail pesanan baru
        return redirect()->route('detailPesanan', ['id' => $pesanan->idPesanan])
            ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu penjemputan oleh kurir.');
    }

    // public function detail($id)
    // {
    //     $user = session('user');
    //     if (!$user) {
    //         return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login dulu.']);
    //     }

    //     $pesanan = Pesanan::with('pelanggan')
    //         ->where('idPesanan', $id)
    //         ->where('idPelanggan', $user['idPelanggan'])
    //         ->firstOrFail();

    //     // if (!$pesanan) {
    //     //     return redirect()->route('pesanLaundry')
    //     //         ->with('error', 'Belum ada pesanan.');
    //     // }

    //     return view('PesananLaundryPengguna.detailPesanan', compact('pesanan'));
    // }

    public function detail($id)
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login sebagai pelanggan terlebih dahulu.']);
        }

        $pesanan = Pesanan::with('pelanggan')
            ->where('idPesanan', $id)
            ->where('idPelanggan', $user['idPelanggan'])
            ->firstOrFail();

        return view('PesananLaundryPengguna.detailPesanan', compact('pesanan'));
    }
}
