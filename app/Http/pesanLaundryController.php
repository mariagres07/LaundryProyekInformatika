<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class pesanLaundryController extends Controller
{
    public function index()
    {
        return view('pesanLaundry');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|array',
            'kategori.*' => 'integer|min:0',
            'paket' => 'required|string',
        ]);

        // Proses data sesuai kebutuhan (misalnya simpan ke database)
        // ...

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Pesanan laundry berhasil dibuat!');
    }

    public function detailPesananPelanggan()
    {
        // Logika untuk menampilkan detail pesanan laundry
        return view('detailPesanan'); // Ganti dengan nama view yang sesuai
    }

}

