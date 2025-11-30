<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Pesanan;

class BuatPengaduanController extends Controller
{
    public function create(Request $request, $idPesanan = null){
    $user = session('pelanggan');

    // Jika datang dari DETAIL PESANAN
    if ($idPesanan) {

        $pesanan = Pesanan::where('idPesanan', $idPesanan)
            ->where('idPelanggan', $user->idPelanggan)
            ->first();

        return view('Pengaduan.BuatPengaduan', [
            'mode' => 'langsung',   // ← mode tanpa dropdown
            'pesananSingle' => $pesanan,
            'pesanan' => collect(), // agar tidak error di blade
            'tanggal' => null
        ]);
    }

    // Jika datang dari halaman BUAT PENGADUAN BIASA
    $tanggal = $request->input('tanggal');

    $pesanan = Pesanan::where('idPelanggan', $user->idPelanggan)
        ->where('statusPesanan', 'Selesai')
        ->when($tanggal, function ($q) use ($tanggal) {
            $q->whereDate('tanggalMasuk', $tanggal);
        })
        ->orderBy('tanggalMasuk', 'desc')
        ->get();

    return view('Pengaduan.BuatPengaduan', [
        'mode' => 'pilih', // ← mode dropdown
        'pesanan' => $pesanan,
        'pesananSingle' => null,
        'tanggal' => $tanggal
    ]);
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