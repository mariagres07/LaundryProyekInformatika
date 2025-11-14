<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\KategoriItem;
use App\Models\Layanan;

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

    public function store(Request $request)
    {
        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $data = $request->json()->all();
        
        // Validasi data
        if (!isset($data['kategori']) || !isset($data['layanan'])) {
            return response()->json(['success' => false, 'message' => 'Data tidak lengkap'], 400);
        }

        // Ambil alamat dari input atau gunakan alamat user
        $alamatInput = document.getElementById('alamat').value;
        $alamat = !empty($alamatInput) ? $alamatInput : ($user['alamat'] ?? 'Alamat tidak diisi');

        // Ambil data layanan
        $layanan = Layanan::find($data['layanan']);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan'], 404);
        }

        // Ambil semua kategori items untuk mapping
        $kategoriItems = KategoriItem::all();
        
        // Inisialisasi jumlah untuk setiap kategori
        $pakaian = 0;
        $seprai = 0;
        $handuk = 0;

        // Map kategori index ke quantity
        foreach ($data['kategori'] as $index) {
            if (isset($kategoriItems[$index])) {
                $namaKategori = strtolower($kategoriItems[$index]->namaKategori);
                
                if (str_contains($namaKategori, 'pakaian')) {
                    $pakaian = 1; // atau quantity yang sesuai
                } elseif (str_contains($namaKategori, 'seprai')) {
                    $seprai = 1;
                } elseif (str_contains($namaKategori, 'handuk')) {
                    $handuk = 1;
                }
            }
        }

        // Hitung estimasi hari
        $paket = strtolower($layanan->namaLayanan);
        $estimasiHari = str_contains($paket, 'express') ? 1 : 3;

        // Buat pesanan
        $pesanan = Pesanan::create([
            'namaPesanan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => $data['layanan'],
            'idKurir'        => null,
            'idKaryawan'     => null,
            'statusPesanan'  => 'Menunggu Penjemputan',
            'alamat'         => $alamat,
            'paket'          => $layanan->namaLayanan,
            'pakaian'        => $pakaian,
            'seprai'         => $seprai,
            'handuk'         => $handuk,
            'beratBarang'    => null,
            'tanggalMasuk'   => now(),
            'tanggalSelesai' => now()->addDays($estimasiHari),
            'totalHarga'     => 0, // Tambahkan logic perhitungan harga sesuai kebutuhan
        ]);

        return response()->json([
            'success' => true,
            'idPesanan' => $pesanan->idPesanan,
            'message' => 'Pesanan berhasil dibuat'
        ]);
    }

    public function checkout(Request $request)
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
        $pakaian = $data['kategori'][0] ?? 0;
        $seprai  = $data['kategori'][1] ?? 0;
        $handuk  = $data['kategori'][2] ?? 0;

        // Tentukan estimasi waktu berdasarkan paket
        $paket = strtolower($layanan->namaLayanan);
        $estimasiHari = str_contains($paket, 'express') ? 1 : 3;

        // Simpan ke database
        $pesanan = Pesanan::create([
            'namaPesanan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => $layanan->idLayanan,
            'idKurir'        => null,
            'idKaryawan'     => null,
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