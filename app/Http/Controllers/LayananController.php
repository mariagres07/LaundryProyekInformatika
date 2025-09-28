<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        // Ambil kategori dari database
        $categories = Layanan::all();

        // Paket bisa statis dulu
        $pakets = [
            (object)['nama' => 'Regular', 'harga' => 5000, 'icon' => '/images/icon-paket.png'],
            (object)['nama' => 'Express', 'harga' => 10000, 'icon' => '/images/icon-paket.png'],
        ];

        // Hati-hati: view ada di folder LayananLaundry
        return view('LayananLaundry.layananLaundry', compact('categories', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'harga' => 'required|numeric',
        ]);

        Layanan::create([
            'nama'  => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        Layanan::destroy($id);
        return redirect()->route('layanan.index')->with('success', 'Data berhasil dihapus');
    }
}
