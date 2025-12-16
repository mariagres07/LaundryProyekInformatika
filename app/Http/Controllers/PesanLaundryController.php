<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\KategoriItem;
use App\Models\Layanan;
use App\Models\Karyawan;
use App\Models\Kurir;

class PesanLaundryController extends Controller
{
    // 🔹 Halaman utama pemesanan laundry
    public function index()
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        $kategoriItems = KategoriItem::select('idKategoriItem', 'namaKategori')->get();
        $layanans = Layanan::select('idLayanan', 'namaLayanan')->get();

        return view('PesananLaundryPengguna.PesanLaundry', [
            'pelanggan' => $user,
            'kategoriItems' => $kategoriItems,
            'layanans' => $layanans,
        ]);
    }

    // 🔹 Menerima data dari fetch() (AJAX)
    public function store(Request $request)
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.'], 401);
        }

        // Validasi
        $data = $request->validate([
            'kategori' => 'required|array',
            'layanan'  => 'required',
            'alamat'   => 'nullable|string|max:255',
        ]);

        // Ambil layanan
        $layanan = Layanan::find($data['layanan']);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.']);
        }

        // Ambil jumlah kategori (urutannya sama dengan di view)
        $kategoriData = $request->input('kategori', []);

        // Ambil semua kategori dari DB
        $kategoriItems = KategoriItem::all();

        // Inisialisasi
        $seprai = $handuk = $pakaian = 0;

        foreach ($kategoriItems as $item) {
            $qty = $kategoriData[$item->idKategoriItem] ?? 0;
            if ($qty <= 0) continue;

            $nama = strtolower($item->namaKategori);

            if (str_contains($nama, 'pakaian')) {
                $pakaian += $qty;
            } elseif (str_contains($nama, 'handuk')) {
                $handuk += $qty;
            } elseif (str_contains($nama, 'seprai') || str_contains($nama, 'selimut') || str_contains($nama, 'bed cover')) {
                $seprai += $qty;
            }
        }

        // Tentukan estimasi waktu berdasarkan paket
        $paket = strtolower($layanan->namaLayanan);
        $estimasiHari = str_contains($paket, 'express') ? 1 : 3;

        $kurir = Kurir::inRandomOrder()->first(); // Pilih kurir acak
        $karyawan = Karyawan::inRandomOrder()->first(); // Pilih karyawan

        if (!$kurir || !$karyawan) {
            return response()->json(['success' => false, 'message' => 'Kurir atau karyawan tidak tersedia.']);
        }
        // Simpan ke database
        $pesanan = Pesanan::create([
            // 'namaPelanggan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => $layanan->idLayanan,
            'idKurir'        => $kurir->idKurir,
            'idKaryawan'     => $karyawan->idKaryawan,
            'statusPesanan'  => 'Menunggu Penjemputan',
            'alamat'         => $data['alamat'] ?? $user['alamat'] ?? 'Belum diisi',
            'paket'          => $layanan->namaLayanan,
            'pakaian'        => $pakaian,
            'seprai'         => $seprai,
            'handuk'         => $handuk,
            'beratBarang'    => null,
            'tanggalMasuk'   => now(),
            'tanggalSelesai' => now()->addDays($estimasiHari),
            'totalHarga'     => null,
        ]);

        return response()->json([
            'success' => true,
            'idPesanan' => $pesanan->idPesanan,
        ]);
    }

    // 🔹 Detail pesanan pelanggan
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