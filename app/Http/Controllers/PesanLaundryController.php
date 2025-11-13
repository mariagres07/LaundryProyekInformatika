<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\KategoriItem;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class PesanLaundryController extends Controller
{
    // 🔹 Halaman utama untuk pelanggan memesan laundry
    public function index()
    {
        $user = session('pelanggan'); // Ambil data pelanggan dari session
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil kategori & layanan dari database
        $kategoriItems = KategoriItem::select('idKategoriItem', 'namaKategori')->get();
        $layanans = Layanan::select('idLayanan', 'namaLayanan')->get();

        return view('PesananLaundryPengguna.PesanLaundry', [
            'pelanggan' => $user,
            'kategoriItems' => $kategoriItems,
            'layanans' => $layanans,
        ]);
    }

    // 🔹 Menerima data AJAX dari tombol "Pesan Sekarang"
    public function store(Request $request)
    {
        $user = session('pelanggan');

        if (!$user || session('role') !== 'pelanggan') {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.'], 401);
        }

        // Validasi input
        $data = $request->validate([
            'kategori' => 'required|array',
            'layanan' => 'required',
        ]);

        // Ambil data kategori dan layanan dari database
        $kategoriItems = KategoriItem::select('idKategoriItem', 'namaKategori')->get();
        $layanan = Layanan::find($data['layanan']);

        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.']);
        }

        // Konversi array index kategori ke nama kolom
        $kategoriCounts = ['pakaian' => 0, 'seprai' => 0, 'handuk' => 0];
        foreach ($data['kategori'] as $index) {
            $nama = strtolower($kategoriItems[$index]->namaKategori ?? '');
            if (str_contains($nama, 'pakaian')) $kategoriCounts['pakaian']++;
            elseif (str_contains($nama, 'seprai')) $kategoriCounts['seprai']++;
            elseif (str_contains($nama, 'handuk')) $kategoriCounts['handuk']++;
        }

        // Estimasi waktu (express = 1 hari, regular = 3 hari)
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
            'alamat'         => $user['alamat'] ?? 'Belum diisi',
            'paket'          => $layanan->namaLayanan,
            'pakaian'        => $kategoriCounts['pakaian'],
            'seprai'         => $kategoriCounts['seprai'],
            'handuk'         => $kategoriCounts['handuk'],
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

    // 🔹 Detail pesanan
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