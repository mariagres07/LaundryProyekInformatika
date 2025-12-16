<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriItem;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $categories = KategoriItem::all();
        $pakets = Layanan::all();

        /* =========================
        ICON KATEGORI
        ========================= */
        foreach ($categories as $cat) {

            if (!empty($cat->icon)) {
                // kalau icon sudah ada di database, pakai itu
                $cat->icon = $cat->icon;
            } 
            elseif (stripos($cat->namaKategori, 'Pakaian') !== false) {
                $cat->icon = 'pakaian.png';
            } 
            elseif (stripos($cat->namaKategori, 'Handuk') !== false) {
                $cat->icon = 'handuk.png';
            } 
            elseif (
                stripos($cat->namaKategori, 'Seprai') !== false ||
                stripos($cat->namaKategori, 'Selimut') !== false ||
                stripos($cat->namaKategori, 'Bed') !== false
            ) {
                $cat->icon = 'selimut.png';
            } 
            else {
                $cat->icon = 'default.png';
            }
        }

        /* =========================
        ICON LAYANAN / PAKET
        ========================= */
        foreach ($pakets as $p) {
            if (stripos($p->namaLayanan, 'Express') !== false) {
                $p->icon = $p->icon ?: 'expresslogo.png';
            } else {
                $p->icon = $p->icon ?: 'regularlogo.png';
            }
        }

        return view('LayananLaundry.layananLaundry', compact('categories', 'pakets'));

    }

    // ===== KATEGORI =====
    public function storeKategori(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
            'hargaPerItem' => 'required|numeric|min:0',
        ]);

        KategoriItem::create([
            'namaKategori' => $request->namaKategori,
            'hargaPerItem' => $request->hargaPerItem,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
            'hargaPerItem' => 'required|numeric|min:0',
        ]);

        $kategori = KategoriItem::findOrFail($id);
        $kategori->update([
            'namaKategori' => $request->namaKategori,
            'hargaPerItem' => $request->hargaPerItem,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil diperbarui');
    }


    public function destroyKategori($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        $kategori->delete();
        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil dihapus');
    }

    // ===== LAYANAN / PAKET =====
    public function store(Request $request)
        {
            $request->validate([
                'jenisPaket' => 'required|in:reguler,express',
                'pewangi'    => 'required|string|max:50',
                'hargaPerKg' => 'required|numeric|min:0',
            ]);

            // Tentukan estimasi otomatis
            if ($request->jenisPaket === 'express') {
                $estimasiHari = 2;
                $namaLayanan  = 'Express (' . $request->pewangi . ')';
            } else {
                $estimasiHari = 4;
                $namaLayanan  = 'Reguler (' . $request->pewangi . ')';
            }

            Layanan::create([
                'namaLayanan'  => $namaLayanan,
                'hargaPerKg'   => $request->hargaPerKg,
                'estimasiHari' => $estimasiHari,
            ]);

            return redirect()->route('layanan.index')
                ->with('success', 'Layanan berhasil ditambahkan');
        }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaLayanan' => 'required|string|max:100',
            'hargaPerKg' => 'required|numeric|min:0',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'namaLayanan' => $request->namaLayanan,
            'hargaPerKg' => $request->hargaPerKg,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus');
    }

    // ===== DATA DEFAULT =====
    private function seedDefaultData()
    {
        $defaultCategories = [
            'Pakaian',
            'Handuk',
            'Seprai/Selimut/Bed cover'
        ];

        foreach ($defaultCategories as $nama) {
            KategoriItem::firstOrCreate(['namaKategori' => $nama]);
        }

        $defaultPakets = [
            ['namaLayanan' => 'Reguler (Fresh Coffee)', 'hargaPerKg' => 5000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Express (Fresh Coffee)', 'hargaPerKg' => 8000, 'estimasiHari' => 1],
            ['namaLayanan' => 'Reguler (Vanila)', 'hargaPerKg' => 5000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Express (Vanila)', 'hargaPerKg' => 8000, 'estimasiHari' => 1],
        ];

        foreach ($defaultPakets as $paket) {
            Layanan::firstOrCreate(
                ['namaLayanan' => $paket['namaLayanan']],
                ['hargaPerKg' => $paket['hargaPerKg'], 'estimasiHari' => $paket['estimasiHari']]
            );
        }
    }
}