<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPembayaran;
use Carbon\Carbon;

class ClihatLap extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai dari dropdown
        $tanggal_awal = $request->input('tanggal_awal');
        $bulan_awal   = $request->input('bulan_awal');
        $tahun_awal   = $request->input('tahun_awal');

        $tanggal_akhir = $request->input('tanggal_akhir');
        $bulan_akhir   = $request->input('bulan_akhir');
        $tahun_akhir   = $request->input('tahun_akhir');

        // Mulai query
        $query = TransaksiPembayaran::query();

        // Jika semua nilai awal dan akhir diisi → filter berdasarkan rentang tanggal
        if ($tanggal_awal && $bulan_awal && $tahun_awal && $tanggal_akhir && $bulan_akhir && $tahun_akhir) {
            // Gabungkan ke format tanggal
            $startDate = Carbon::createFromDate($tahun_awal, $bulan_awal, $tanggal_awal)->startOfDay();
            $endDate   = Carbon::createFromDate($tahun_akhir, $bulan_akhir, $tanggal_akhir)->endOfDay();

            $query->whereBetween('tanggalPembayaran', [$startDate, $endDate]);
        }

        // Ambil hasil data (urut terbaru)
        $data = $query->orderBy('tanggalPembayaran', 'desc')->get();

        return view('LihatLaporan.lihatLaporan', compact(
            'data',
            'tanggal_awal',
            'bulan_awal',
            'tahun_awal',
            'tanggal_akhir',
            'bulan_akhir',
            'tahun_akhir'
        ));
    }
}