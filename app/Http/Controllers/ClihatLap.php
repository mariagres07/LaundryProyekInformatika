<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPembayaran;
use Carbon\Carbon;

// KARYAWAN 
class ClihatLap extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai dari dropdown
        $tanggalAwal = $request->input('tanggal_awal');
        // $bulan_awal   = $request->input('bulan_awal');
        // $tahun_awal   = $request->input('tahun_awal');

        $tanggalAkhir = $request->input('tanggal_akhir');
        // $bulan_akhir   = $request->input('bulan_akhir');
        // $tahun_akhir   = $request->input('tahun_akhir');

        // Variabel untuk menampung data
        // $data = collect();

        // Mulai query
        $query = TransaksiPembayaran::query();

        // Jika semua nilai awal dan akhir diisi → filter berdasarkan rentang tanggal
        if ($tanggalAwal && $tanggalAkhir) {

            $request->validate([
                'tanggal_awal'  => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            ], [
                'tanggal_awal.required' => 'Tanggal awal harus diisi.',
                'tanggal_akhir.required' => 'Tanggal akhir harus diisi.',
                'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal awal.',

            ]);
            $startDate = Carbon::parse($tanggalAwal)->startOfDay()->toDateTimeString();
            $endDate   = Carbon::parse($tanggalAkhir)->endOfDay()->toDateTimeString();
            $query->whereBetween('tanggalPembayaran', [$startDate, $endDate]);
        } else {
            $defaultStartDate = Carbon::now()->subDays(30)->startOfDay();
            $query->where('tanggalPembayaran', '>=', $defaultStartDate);

            $startDate = null;
            $endDate = null;
        }

        // Ambil hasil data (urut terbaru)
        $data = $query->orderBy('tanggalPembayaran', 'desc')->get();

        return view('LihatLaporan.lihatLaporan', compact(
            'data',
            'tanggalAwal',
            'tanggalAkhir',
        ));
    }
}
