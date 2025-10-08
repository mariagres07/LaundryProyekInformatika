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
            (object)['namaLayanan' => 'Regular (Fresh Coffe)', 'hargaPerKg' => 5000, 'icon' => '/regularlogo.png'],
            (object)['namaLayanan' => 'Express (Fresh Coffe)', 'hargaPerKg' => 10000, 'icon' => '/Expresslogo.png'],
            (object)['namaLayanan' => 'Regular (Vanila)', 'hargaPerKg' => 5000, 'icon' => '/regularlogo.png'],
            (object)['namaLayanan' => 'Express (Vanila)', 'hargaPerKg' => 10000, 'icon' => '/Expresslogo.png'],
        ];

        // Hati-hati: view ada di folder LayananLaundry
        return view('LayananLaundry.layananLaundry', compact('categories', 'pakets'));
    }

    public function store(Request $request)
{
    $request->validate([
        'namaLayanan'  => 'required|string|max:100',
        'hargaPerKg' => 'required|numeric',
    ]);

    // Tentukan estimasi otomatis
    $estimasiHari = 2; // default
    if (stripos($request->namaLayanan, 'express') !== false) {
        $estimasiHari = 1;
    } elseif (stripos($request->namaLayanan, 'regular') !== false) {
        $estimasiHari = 2;
    }

    Layanan::create([
        'namaLayanan'  => $request->namaLayanan,
        'hargaPerKg' => $request->hargaPerKg,
        'estimasiHari' => $estimasiHari,
    ]);

    return redirect()->route('layanan.index')->with('success', 'Data berhasil disimpan');
}

    public function destroy($id)
    {
        Layanan::destroy($id);
        return redirect()->route('layanan.index')->with('success', 'Data berhasil dihapus');
    }
}
