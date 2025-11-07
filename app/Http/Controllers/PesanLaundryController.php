<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\KategoriItem;
use App\Models\Layanan;     

class PesanLaundryController extends Controller
{
    public function index()
    {
        $user = session('pelanggan'); // Ambil data pelanggan dari session
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 🔹 Ambil data kategori dan layanan dari database
        $kategoriItems = KategoriItem::select('idKategoriItem', 'namaKategori')->get();
        $layanans = Layanan::select('idLayanan', 'namaLayanan')->get();

        // 🔹 Kirim data pelanggan + kategori + layanan ke view
        return view('PesananLaundryPengguna.PesanLaundry', [
            'pelanggan' => $user,
            'kategoriItems' => $kategoriItems,
            'layanans' => $layanans,
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'namaPesanan' => 'required',
            'idLayanan'  => 'required',
            'alamat'      => 'required',
            'paket'       => 'required',
        ]);

        $user = session('pelanggan');
        if (!$user || session('role') !== 'pelanggan') {
            return redirect()->route('login.show')->withErrors(['auth' => 'Silakan login sebagai pelanggan terlebih dahulu.']);
        }

        $paket = strtolower($request->input('paket', 'reguler'));
        $estimasiHari = str_contains($paket, 'express') ? 1 : 3;

        $pesanan = Pesanan::create([
            'namaPesanan'    => 'Pesanan ' . $user['namaPelanggan'],
            'idPelanggan'    => $user['idPelanggan'],
            'idLayanan'      => $request->idLayanan,
            'idKurir'        => null,
            'idKaryawan'     => null,
            'statusPesanan'  => 'Menunggu Penjemputan',
            'alamat'         => $request->alamat,
            'paket'          => $request->paket,
            'pakaian'        => (int) $request->pakaian,
            'seprai'         => (int) $request->seprai,
            'handuk'         => (int) $request->handuk,
            'beratBarang'    => null,
            'tanggalMasuk'   => now(),
            'tanggalSelesai' => now()->addDays($estimasiHari),
            'totalHarga'     => null,
        ]);

        return redirect()->route('detailPesanan', ['id' => $pesanan->idPesanan])
            ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu penjemputan oleh kurir.');
    }

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
