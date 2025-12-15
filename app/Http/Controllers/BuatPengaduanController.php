<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Pesanan;

class BuatPengaduanController extends Controller
{
    public function create(Request $request, $idPesanan = null)
    {
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
            'tanggalPengaduan' => now()->format('d/m/Y')
        ]);

        return redirect()->route('pengaduan.create')->with('pesan', 'Pengaduan berhasil dikirim!');
    }

    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('daftar-pengaduan', compact('pengaduans'));
    }

    public function riwayat(Request $request)
    {
        $pelanggan = session('pelanggan');

        if (!$pelanggan) {
            return redirect()->route('login.show'); // pastikan login
        }

        $idPelanggan = $pelanggan->idPelanggan; // ambil ID saja

        $query = Pengaduan::where('idPelanggan', $idPelanggan);

        // Filter status
        if ($request->status) {
            $query->where('statusPengaduan', $request->status);
        }
        // ==============================
        // FILTER TANGGAL
        // ==============================
        $from = request('start_date');
        $to = request('end_date');

        // Validasi tanggal salah (from lebih besar dari to)
        if ($from && $to && $from > $to) {
            return redirect()->back()->with('error', 'Rentang tanggal tidak valid.');
        }

        if (request('from')) {
            $pesanan->whereDate('tanggalPengaduan', '>=', request('from'));
        }

        if (request('to')) {
            $pesanan->whereDate('tanggalPengaduan', '<=', request('to'));
        }
        
        // Search berdasarkan judul
        // if ($request->search) {
        //     $query->where('judulPengaduan', 'like', '%' . $request->search . '%');
        // }

        $pengaduan = $query->orderBy('tanggalPengaduan', 'desc')->get();
        return view('Pengaduan.RiwayatPengaduan', compact('pengaduan'));
    }

    public function detail($idPengaduan)
    {
        $pelanggan = session('pelanggan'); // ambil object pelanggan

        if (!$pelanggan) {
            return redirect()->route('login.show'); // pastikan login
        }

        $idPelanggan = $pelanggan->idPelanggan; // ambil ID saja

        $pengaduan = Pengaduan::where('idPengaduan', $idPengaduan)
            ->where('idPelanggan', $idPelanggan)
            ->firstOrFail();

        return view('Pengaduan.DetailPengaduanPelanggan', compact('pengaduan'));
    }
}