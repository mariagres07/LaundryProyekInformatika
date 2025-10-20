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
        // Kalau klik tombol "TIDAK"
        if ($request->input('aksi') === 'tidak') {
            return redirect()->route('pengaduan.create')
                ->with('pesan', 'Pengaduan dibatalkan');
        }

        // Upload file media
        $filePathMedia = null;
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/mediaPengaduan'), $filename);
            $filePathMedia = $filename;
        }

        // Upload file lampiran
        $filePathLampiran = null;
        if ($request->hasFile('lampiran')) {
            $filePathLampiran = $request->file('lampiran')->store('pengaduan', 'public');
        }

        // Simpan ke database
        Pengaduan::create([
            'idPelanggan'      => 1,
            'idPesanan'        => 1,
            'judulPengaduan'   => $request->judul,
            'deskripsi'        => $request->deskripsi,
            'media'            => $filePathMedia ?? $filePathLampiran,
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
