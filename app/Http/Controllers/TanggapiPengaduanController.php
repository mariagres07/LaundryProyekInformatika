<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TanggapiPengaduanController extends Controller
{
    // Tampilkan daftar pengaduan
    public function index()
    {
        try {
            // Mengambil semua pengaduan dengan relasi pelanggan
            $pengaduans = Pengaduan::with('pelanggan')->get();
        } catch (\Exception $e) {
            Log::error("Gagal memuat daftar pengaduan: " . $e->getMessage());
            $pengaduans = collect();
        }

        return view('Pengaduan.ListTanggapiPengaduan', compact('pengaduans'));
    }

    // Tampilkan detail pengaduan dan form tanggapan
    public function show(string $idPengaduan)
    {
        try {
            $pengaduan = Pengaduan::with('pelanggan')->findOrFail($idPengaduan);
            return view('DetailTanggapiPengaduan', compact('pengaduan'));
        } catch (\Exception $e) {
            Log::error("Gagal memuat detail pengaduan: " . $e->getMessage());
            return redirect()->route('pengaduan.index')->with('error', 'Pengaduan tidak ditemukan.');
        }
    }

    // Kirim tanggapan
    public function kirimTanggapan(Request $request, string $idPengaduan)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        try {
            // Gunakan transaction untuk keamanan data
            DB::beginTransaction();

            $pengaduan = Pengaduan::findOrFail($idPengaduan);

            // Update tanggapan dan status
            $pengaduan->update([
                'tanggapanPengaduan' => $request->input('pesan'),
                'status' => 'Ditanggapi'
            ]);

            DB::commit();

            return redirect()->route('pengaduan.show', $idPengaduan)
                ->with('success', 'Tanggapan berhasil dikirim!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal mengirim tanggapan: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan tanggapan: ' . $e->getMessage());
        }
    }

    // Tandai pengaduan sebagai selesai
    public function selesaikan(string $idPengaduan)
    {
        try {
            DB::beginTransaction();

            $pengaduan = Pengaduan::findOrFail($idPengaduan);
            $pengaduan->update([
                'status' => 'Selesai'
            ]);

            DB::commit();

            return redirect()->route('pengaduan.index')
                ->with('success', 'Pengaduan telah ditandai sebagai selesai.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal menyelesaikan pengaduan: " . $e->getMessage());
            return back()->with('error', 'Gagal menandai pengaduan sebagai selesai: ' . $e->getMessage());
        }
    }
}
