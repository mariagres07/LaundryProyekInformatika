<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class BuatPengaduanController extends Controller
{
    /**
     * Menampilkan formulir pembuatan pengaduan.
     */
    public function create()
    {
        // Ambil data pelanggan dan pesanan untuk dropdown
        $pelanggans = Pelanggan::all();
        $pesanans = Pesanan::all();
        
        return view('BuatPengaduan', compact('pelanggans', 'pesanans'));
    }

    /**
     * Memproses data yang dikirim dari formulir pengaduan.
     */
    public function store(Request $request)
    {
        // 1. Cek aksi tombol (TIDAK)
        if ($request->input('aksi') === 'tidak') {
            return redirect()->route('pengaduan.create')->with('pesan', 'Pengaduan Dibatalkan');
        }

        // 2. Validasi Data untuk tombol YA
        $validatedData = $request->validate([
            'idPelanggan' => 'required|exists:pelanggan,idPelanggan',
            'idPesanan' => 'required|exists:pesanan,idPesanan',
            'deskripsi' => 'required|string|min:10'
        ]);

        try {
            // 3. Simpan Data Pengaduan ke Database
            Pengaduan::create([
                'idPelanggan' => $validatedData['idPelanggan'],
                'idPesanan' => $validatedData['idPesanan'],
                'deskripsi' => $validatedData['deskripsi'],
                'tanggalPengaduan' => now()->format('Y-m-d') // Sesuai tipe date di database
            ]);

            // 4. Redirect dengan pesan sukses
            return redirect()->route('pengaduan.create')->with('success', 'Pengaduan berhasil dikirim!');

        } catch (\Exception $e) {
            // Jika ada error database/penyimpanan
            return redirect()->back()->withInput()->with('pesan', 'Gagal menyimpan pengaduan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan daftar pengaduan (opsional)
     */
    public function index()
    {
        $pengaduans = Pengaduan::with(['pelanggan', 'pesanan'])->get();
        return view('daftar-pengaduan', compact('pengaduans'));
    }
}