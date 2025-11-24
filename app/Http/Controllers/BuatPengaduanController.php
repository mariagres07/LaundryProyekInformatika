<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Pesanan;

class BuatPengaduanController extends Controller
{
    public function create(Request $request)
    {
        $user = session('pelanggan');

        // Ambil tanggal dari form (optional)
        $tanggal = $request->input('tanggal');

        $pesanan = Pesanan::where('idPelanggan', $user->idPelanggan)
            ->where('statusPesanan', 'Selesai')   // ⬅ WAJIB untuk syarat bikin pengaduan
            ->when($tanggal, function ($q) use ($tanggal) {
                $q->whereDate('created_at', $tanggal);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pengaduan.BuatPengaduan', compact('pesanan', 'tanggal'));
    }

    public function store(Request $request)
    {
        // Kalau klik tombol TIDAK
        if ($request->input('aksi') === 'tidak') {
            return redirect()->route('pengaduan.create')
                ->with('pesan', 'Pengaduan dibatalkan');
        }

        // // Upload file media
        // $filePathMedia = null;

        // if ($request->hasFile('media')) {
        //     $file = $request->file('media');
        //     $filename = time() . '-' . $file->getClientOriginalName();
        //     $file->move(public_path('images/mediaPengaduan'), $filename);
        //     $filePathMedia = $filename;
        // }

        // Validasi
        $request->validate([
            'idPesanan' => 'required|exists:pesanan,idPesanan',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $user = session('pelanggan');

        // Upload file lampiran
        $filePathLampiran = null;
        if ($request->hasFile('lampiran')) {
            $filePathLampiran = $request->file('lampiran')->store('pengaduan', 'public');
        }

        // Simpan ke database
        Pengaduan::create([
            'idPelanggan'      => $user->idPelanggan,
            'idPesanan'        => $request->idPesanan,
            'judulPengaduan'   => $request->judul,
            'deskripsi'        => $request->deskripsi,
            'media'            => $filePathLampiran,
            'statusPengaduan'   => 'Belum Ditanggapi',
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
