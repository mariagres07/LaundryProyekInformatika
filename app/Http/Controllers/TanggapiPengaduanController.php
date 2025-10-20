<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;

class TanggapiPengaduanController extends Controller
{
    //Tampilkan daftar pengaduan
    public function index()
    {
        try {
            $pengaduans = Pengaduan::with('pelanggan')->get();
            return view('Pengaduan.ListTanggapiPengaduan', compact('pengaduans'));
        } catch (\Exception $e) {
            Log::error("Gagal memuat daftar pengaduan: " . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar pengaduan.');
        }
    }

    //Tampilkan detail pengaduan dan form tanggapan
    public function show(string $idPengaduan)
    {
        try {
            $pengaduan = Pengaduan::with('pelanggan')->findOrFail($idPengaduan);
            return view('Pengaduan.DetailTanggapiPengaduan', compact('pengaduan'));
        } catch (\Exception $e) {
            Log::error("Gagal memuat detail pengaduan: " . $e->getMessage());
            return redirect()->route('pengaduan.index')->with('error', 'Pengaduan tidak ditemukan.');
        }
    }

    //Kirim tanggapan
    public function kirimTanggapan(Request $request, string $idPengaduan)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        try {
            $pengaduan = Pengaduan::findOrFail($idPengaduan);
            $pengaduan->tanggapanPengaduan = $request->input('pesan');
            $pengaduan->statusPengaduan = 'Ditanggapi';
            $pengaduan->save();

            return redirect()->route('pengaduan.show', $idPengaduan)
                ->with('success', 'Tanggapan berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error("Gagal mengirim tanggapan: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan tanggapan.');
        }
    }

    //Tandai pengaduan sebagai selesai
    public function selesaikan(string $idPengaduan)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($idPengaduan);
            $pengaduan->statusPengaduan = 'Selesai';
            $pengaduan->save();

            return redirect()->route('pengaduan.index')
                ->with('success', 'Pengaduan telah ditandai sebagai selesai.');
        } catch (\Exception $e) {
            Log::error("Gagal menyelesaikan pengaduan: " . $e->getMessage());
            return back()->with('error', 'Gagal menandai pengaduan sebagai selesai.');
        }
    }
}
