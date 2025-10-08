<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class BuatPengaduanController extends Controller
{
    public function create()
    {
        return view('Pengaduan.BuatPengaduan');
    }
    public function store(Request $request)
    {
        // kalau klik tombol "TIDAK"
        if ($request->input('aksi') === 'tidak') {
            return redirect()->route('pengaduan.create')
                ->with('pesan', 'Pengaduan dibatalkan');
        }

        // --- Upload file kalau ada ---
        $filePath = null;
        if ($request->hasFile('lampiran')) {
            $filePath = $request->file('lampiran')->store('pengaduan', 'public');
        }

        // --- Simpan ke DB ---
        Pengaduan::create([
            'idPelanggan'      => 1,  // sementara fix isi "1"
            'idPesanan'        => 1,  // sementara fix isi "1"
            'judulPengaduan'   => $request->judul,
            'deskripsi'        => $request->deskripsi,
            'media'            => $filePath,
            'tanggalPengaduan' => now()->format('Y-m-d')
        ]);

        return redirect()->route('pengaduan.create')->with('pesan', 'Pengaduan berhasil dikirim!');
    }

    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('daftar-pengaduan', compact('pengaduans'));
    }
}
