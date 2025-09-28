<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TransaksiPembayaran;

class ClihatLap extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal');

        $query = TransaksiPembayaran::query();

        if($tanggal){
            $query->whereDate('tanggalPembayaran', $tanggal);
        }
        $data = $query->orderBy('tanggalPembayaran','desc')->get();

        return view('LihatLaporan.lihatLaporan', compact('data', 'tanggal'));
    }

}