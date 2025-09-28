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
            'paket'  => 'required'
        ]);

        // Simpan data ke session
        session(['pesanan' => [
            'nama'     => auth()->user()->name,
            'alamat'   => $request->alamat,
            'kategori' => $request->kategori,
            'paket'    => $request->paket,
        ]]);

        return redirect()->route('detailPesanan');
    }

    public function detail($id)
    {
        $pesanan = session('pesanan'); // ambil data dari session

        return view('PesananLaundryPengguna.detailPesanan', $pesanan);
    }
}
