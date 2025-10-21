<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriItem;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $this->seedDefaultData();

        $categories = KategoriItem::all();
        $pakets = Layanan::all();

        foreach ($categories as $cat) {
        switch ($cat->namaKategori) {
            case 'Pakaian':
                $cat->hargaDisplay = 7000;
                $cat->icon = 'pakaian.png';
                break;
            case 'Handuk':
                $cat->hargaDisplay = 5000;
                $cat->icon = 'handuk.png';
                break;
            case 'Seprai/Selimut/Bed cover':
                $cat->hargaDisplay = 9000;
                $cat->icon = 'selimut.png';
                break;
            default:
                $cat->hargaDisplay = 0;
                $cat->icon = 'default.png';
        }
    }

    // Tambahkan ikon layanan
    foreach ($pakets as $p) {
        if (stripos($p->namaLayanan, 'Express') !== false) {
            $p->icon = 'expresslogo.png';
        } else {
            $p->icon = 'regularlogo.png';
        }
    }

    return view('LayananLaundry.layananLaundry', compact('categories', 'pakets'));
}

    // ===== TAMBAH KATEGORI (tidak ada harga di database) =====
    public function storeKategori(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
        ]);

        KategoriItem::create([
            'namaKategori' => $request->namaKategori
        ]);

        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    private function seedDefaultData()
    {
        // ====== Cek dan tambahkan kategori default ======
        $defaultCategories = [
            'Pakaian',
            'Handuk',
            'Seprai/Selimut/Bed cover'
        ];

        foreach ($defaultCategories as $nama) {
            KategoriItem::firstOrCreate(['namaKategori' => $nama]);
        }

        // ====== Cek dan tambahkan layanan default ======
        $defaultPakets = [
            ['namaLayanan' => 'Regular (Fresh Coffe)', 'hargaPerKg' => 8000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Express (Fresh Coffe)', 'hargaPerKg' => 10000, 'estimasiHari' => 1],
            ['namaLayanan' => 'Regular (Vanila)', 'hargaPerKg' => 8000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Express (Vanila)', 'hargaPerKg' => 10000, 'estimasiHari' => 1],
        ];

        foreach ($defaultPakets as $paket) {
            Layanan::firstOrCreate(
                ['namaLayanan' => $paket['namaLayanan']],
                ['hargaPerKg' => $paket['hargaPerKg'], 'estimasiHari' => $paket['estimasiHari']]
            );
        }
    }    
    // ===== TAMBAH JENIS PAKET =====
    public function store(Request $request)
    {
        $request->validate([
            'namaLayanan'  => 'required|string|max:100',
            'hargaPerKg'   => 'required|numeric',
        ]);

        // Estimasi otomatis (default 2 hari, express = 1 hari)
        $estimasiHari = stripos($request->namaLayanan, 'express') !== false ? 1 : 2;

        Layanan::create([
            'namaLayanan'  => $request->namaLayanan,
            'hargaPerKg'   => $request->hargaPerKg,
            'estimasiHari' => $estimasiHari,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    // ===== HAPUS JENIS PAKET =====
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus');
    }

    // ===== HAPUS KATEGORI =====
    public function destroyKategori($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        $kategori->delete();
        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil dihapus');
    }
}
