<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
// use App\Models\ChatPengaduan; // Dihapus karena tidak menggunakan sistem chat
use Illuminate\Support\Facades\Auth; // Digunakan untuk mendapatkan ID Karyawan yang login
use Illuminate\Support\Facades\Log; // Digunakan untuk logging error

class PengaduanController extends Controller
{
    /**
     * Tampilkan daftar pengaduan yang perlu ditanggapi oleh karyawan (Pending).
     * Sesuai dengan halaman 'Tanggapi Pengaduan'
     */
    public function index()
    {
        // Ambil pengaduan yang statusnya 'Baru' atau 'Ditanggapi' (Belum Selesai).
        // Memuat relasi pelanggan untuk menampilkan informasi di daftar.
        // Asumsi model Pengaduan memiliki scopePending() untuk filter status.
        try {
             $pengaduans = Pengaduan::pending()
                ->with('pelanggan')
                ->get();
        } catch (\Exception $e) {
            Log::error("Gagal memuat daftar pengaduan karyawan: " . $e->getMessage());
            $pengaduans = collect(); // Kembalikan koleksi kosong jika terjadi error
        }
       
        return view('karyawan.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Tampilkan halaman detail pengaduan.
     * Halaman ini akan menampilkan deskripsi pelanggan dan kolom untuk mengisi tanggapan.
     * @param string $idPengaduan ID unik dari Pengaduan
     */
    public function show(string $idPengaduan)
    {
        // Cari data Pengaduan, jika tidak ditemukan akan throw 404.
        // Eager load relasi pelanggan dan pesanan saja.
        $pengaduan = Pengaduan::with(['pelanggan', 'pesanan'])
            ->findOrFail($idPengaduan);

        return view('karyawan.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Simpan tanggapan dari karyawan langsung ke kolom Pengaduan.
     * Model Pengaduan diasumsikan memiliki kolom 'tanggapan_karyawan' dan 'idKaryawan'.
     * @param Request $request Data pesan dari form
     * @param string $idPengaduan ID unik dari Pengaduan
     */
    public function kirimTanggapan(Request $request, string $idPengaduan)
    {
        // 1. Validasi input pesan
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        $pengaduan = Pengaduan::findOrFail($idPengaduan);

        // 2. Dapatkan ID pengguna (karyawan) yang sedang login
        $idKaryawan = Auth::id(); 
        
        // *Fallback jika autentikasi belum diimplementasikan*
        if (!$idKaryawan) {
             $idKaryawan = 1; // Asumsi ID karyawan default adalah 1
        }

        try {
            // 3. Simpan tanggapan dan ID Karyawan yang merespons ke model Pengaduan
            $pengaduan->tanggapan_karyawan = $request->input('pesan');
            $pengaduan->idKaryawan = $idKaryawan; // Asumsi ada kolom idKaryawan di Pengaduan

            // 4. Perbarui status pengaduan menjadi 'Ditanggapi'
            if ($pengaduan->status !== 'Selesai') {
                 $pengaduan->status = 'Ditanggapi';
            }
            $pengaduan->save();

            // Redirect kembali ke halaman detail pengaduan
            return redirect()->route('karyawan.pengaduan.show', $idPengaduan)
                             ->with('success', 'Tanggapan berhasil dikirim!');

        } catch (\Exception $e) {
            Log::error("Gagal mengirim tanggapan pengaduan (Non-Chat): " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan tanggapan.');
        }
    }
    
    /**
     * Ubah status pengaduan menjadi Selesai.
     * @param string $idPengaduan ID unik dari Pengaduan
     */
    public function selesaikan(string $idPengaduan)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($idPengaduan);
            
            $pengaduan->status = 'Selesai';
            $pengaduan->save();

            // Redirect kembali ke daftar pengaduan
            return redirect()->route('karyawan.pengaduan.index')
                             ->with('success', 'Pengaduan berhasil ditandai Selesai.');
        } catch (\Exception $e) {
            Log::error("Gagal menyelesaikan pengaduan: " . $e->getMessage());
            return back()->with('error', 'Gagal menandai pengaduan sebagai selesai.');
        }
    }
}

