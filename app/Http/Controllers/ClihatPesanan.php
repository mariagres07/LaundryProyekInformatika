<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class ClihatPesanan extends Controller
{
    // Halaman daftar pesanan
    public function index()
    {
        $user = Auth::user();

        // Cek role user
        if ($user->role === 'pelanggan') {
            // Pelanggan hanya lihat pesanan miliknya
            $pesanan = Pesanan::with(['layanan', 'detailTransaksi.kategoriItem'])
                ->where('idPelanggan', $user->idPelanggan)
                ->orderBy('tanggalMasuk', 'desc')
                ->get();

            return view('lihatDataPesanan.pelanggan', compact('pesanan'));
        }

        if ($user->role === 'kurir') {
            // Kurir lihat semua pesanan yang menunggu penjemputan
            $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
                ->where('statusPesanan', 'Menunggu Penjemputan')
                ->orderBy('tanggalMasuk', 'desc')
                ->get();

            return view('lihatDataPesanan.kurir', compact('pesanan'));
        }

        if ($user->role === 'karyawan') {
            // Karyawan lihat semua pesanan
            $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
                ->orderBy('tanggalMasuk', 'desc')
                ->get();

            return view('lihatDataPesanan.karyawan', compact('pesanan'));
        }

        // Kalau role tidak dikenal
        abort(403, 'Akses ditolak.');
    }

    // Detail pesanan
    public function lihatDetail($id)
    {
        $user = Auth::user();

        // Ambil satu pesanan berdasarkan id
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);

        // Validasi tambahan (kalau pelanggan, hanya boleh lihat pesanan miliknya)
        if ($user->role === 'pelanggan' && $pesanan->idPelanggan !== $user->idPelanggan) {
            abort(403, 'Anda tidak boleh melihat pesanan ini.');
        }

        // Pilih view sesuai role
        if ($user->role === 'kurir') {
            return view('lihatDataPesanan.detail_kurir', compact('pesanan'));
        } elseif ($user->role === 'karyawan') {
            return view('lihatDataPesanan.detail_karyawan', compact('pesanan'));
        } else {
            return view('lihatDataPesanan.detail_pelanggan', compact('pesanan'));
        }
    }
}