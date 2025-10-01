<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

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
            'paket'  => 'required'
        ]);


        $estimasi = str_contains(strtolower($request->paket), 'express') ? '1 Hari' : '3 Hari';


        $hargaPerKategori = [
            'pakaian' => 5000,
            'seprai'  => 10000,
            'handuk'  => 7000,
        ];

        $total = 0;
        foreach ($hargaPerKategori as $key => $harga) {
            $jumlah = (int) $request->input($key, 0);
            $total += $jumlah * $harga;
        }

        // Tambahkan biaya paket
        $biayaPaket = str_contains(strtolower($request->paket), 'express') ? 15000 : 10000;
        $total += $biayaPaket;

        // Simpan ke session
        session([
            'nama'     => Auth::check() ? Auth::user()->namaPelanggan : 'Pelanggan',
            'alamat'   => $request->alamat,
            'kategori' => "Pakaian: {$request->pakaian}, Seprai: {$request->seprai}, Handuk: {$request->handuk}",
            'paket'    => $request->paket,
            'estimasi' => $estimasi,
            'harga'    => 'Rp ' . number_format($total, 0, ',', '.'),
        ]);

        return redirect()->route('detailPesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function detail()
    {
        $pesanan = [
            'nama'     => session('nama'),
            'alamat'   => session('alamat'),
            'kategori' => session('kategori'),
            'paket'    => session('paket'),
            'estimasi' => session('estimasi'),
            'harga'    => session('harga'),
        ];

        if (!$pesanan['nama']) {
            return redirect()->route('pesanLaundry')->with('error', 'Belum ada pesanan.');
        }

        return view('PesananLaundryPengguna.detailPesanan', compact('pesanan'));
    }
}
