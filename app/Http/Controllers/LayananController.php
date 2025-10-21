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

        // Tambahkan icon dan harga display kategori
        foreach ($categories as $cat) {
            switch ($cat->namaKategori) {
                case 'Pakaian':
                    $cat->hargaDisplay = 5000;
                    $cat->icon = $cat->icon ?: 'pakaian.png';
                    break;
                case 'Handuk':
                    $cat->hargaDisplay = 9000;
                    $cat->icon = $cat->icon ?: 'handuk.png';
                    break;
                case 'Seprai/Selimut/Bed cover':
                    $cat->hargaDisplay = 10000;
                    $cat->icon = $cat->icon ?: 'selimut.png';
                    break;
                default:
                    $cat->hargaDisplay = $cat->harga ?? 0;
                    $cat->icon = $cat->icon ?: 'default.png';
            }
        }

        // Tambahkan icon layanan
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
            'harga' => 'nullable|numeric|min:0',
        ]);

        KategoriItem::create([
            'namaKategori' => $request->namaKategori,
            'harga' => $request->harga ?? null,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $kategori = KategoriItem::findOrFail($id);
        $kategori->update([
            'namaKategori' => $request->namaKategori,
            'harga' => $request->harga ?? null,
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
            'namaLayanan' => 'required|string|max:100',
            'hargaPerKg' => 'required|numeric|min:0',
        ]);

        Layanan::create([
            'namaLayanan' => $request->namaLayanan,
            'hargaPerKg' => $request->hargaPerKg,
            'estimasiHari' => 2,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan');
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
}
