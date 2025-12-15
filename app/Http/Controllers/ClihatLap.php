<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// KARYAWAN 
class ClihatLap extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai dari dropdown
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Mulai query
        $query = TransaksiPembayaran::query()
            ->join('detailTransaksi', 'transaksiPembayaran.idDetailTransaksi', '=', 'detailTransaksi.idDetailTransaksi')
            ->select('transaksiPembayaran.*', 'detailTransaksi.idPesanan');

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

            // Set kembali variabel tanggal untuk dikirim ke view (agar nilai di form tetap ada)
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
        } else {
            $defaultStartDate = Carbon::now()->subDays(30)->startOfDay();
            $query->where('tanggalPembayaran', '>=', $defaultStartDate);

            $startDate = null;
            $endDate = null;
        }

        // Ambil hasil data (urut terbaru) dan paginasi 10 data per halaman
        $data = $query->orderBy('tanggalPembayaran', 'desc')->paginate(10)->withQueryString();

        return view('LihatLaporan.lihatLaporan', compact(
            'data',
            'tanggalAwal',
            'tanggalAkhir',
        ));
    }
}
