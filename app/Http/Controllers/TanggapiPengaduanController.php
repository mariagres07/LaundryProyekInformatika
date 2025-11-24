<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;

class TanggapiPengaduanController extends Controller
{
    //Tampilkan daftar pengaduan
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterStatus = $request->input('status', 'all');

        // daftar status yang ditampilkan di dropdown (sesuaikan jika perlu)
        $statuses = [
            'all' => 'Semua',
            'Belum Ditanggapi' => 'Belum Ditanggapi',
            'Ditanggapi' => 'Ditanggapi',
        ];

        $pengaduan = Pengaduan::query()
            ->when($search, function ($q) use ($search) {
                $q->where('idPesanan', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('judulPengaduan', 'like', "%{$search}%");
            })
            ->when($filterStatus && $filterStatus !== 'all', function ($q) use ($filterStatus) {
                $q->where('statusPengaduan', $filterStatus);
            })
            ->orderBy('idPengaduan', 'desc')
            ->paginate(10)
            ->appends($request->only(['search', 'status']));

        return view('Pengaduan.ListTanggapiPengaduan', compact('pengaduan', 'search', 'filterStatus', 'statuses'));
    }

    //Tampilkan detail pengaduan dan form tanggapan
    public function show($idPengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($idPengaduan);
        return view('Pengaduan.detailTanggapiPengaduan', compact('pengaduan'));
    }

    // Form tanggapi pengaduan
    public function edit($idPengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($idPengaduan);
        return view('Pengaduan.detailTanggapiPengaduan', compact('pengaduan'));
    }

    public function kirimTanggapan(Request $request, $idPengaduan)
    {
        $request->validate([
            'tanggapan' => 'required|string'
        ]);

        $pengaduan = Pengaduan::findOrFail($idPengaduan);

        // update status menjadi 'Ditanggapi'
        $pengaduan->update([
            'tanggapan' => $request->tanggapan,
            'statusPengaduan' => 'Ditanggapi'
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditanggapi!');
    }

    //Tandai pengaduan telah selesai
    public function selesaikan($idPengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($idPengaduan);
        $pengaduan->update([
            'statusPengaduan' => 'Selesai'
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diselesaikan!');
    }
}
