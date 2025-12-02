<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Session;

class ClihatPesanan extends Controller
{
    public function index()
    {
        $role = Session::get('role');

        if (!$role) {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($role === 'pelanggan') {
            $user = Session::get('pelanggan');
            $pesanan = Pesanan::with(['layanan', 'detailTransaksi.kategoriItem'])
                ->where('idPelanggan', $user->idPelanggan)
                ->orderBy('tanggalMasuk', 'desc');
            // ->get();


            // ==============================
            // FILTER STATUS
            // ==============================
            if (request('status')) {
                $pesanan->where('statusPesanan', request('status'));
            }

            // ==============================
            // FILTER TANGGAL
            // ==============================
            if (request('from')) {
                $pesanan->whereDate('tanggalMasuk', '>=', request('from'));
            }

            if (request('to')) {
                $pesanan->whereDate('tanggalMasuk', '<=', request('to'));
            }

            // ==============================
            // SEARCH
            // (cari berdasarkan id, layanan, atau status)
            // ==============================
            if (request('search')) {
                $keyword = request('search');
                $pesanan->where(function ($q) use ($keyword) {
                    $q->where('idPesanan', 'LIKE', "%$keyword%")
                        ->orWhere('statusPesanan', 'LIKE', "%$keyword%")
                        ->orWhereHas('layanan', function ($lay) use ($keyword) {
                            $lay->where('namaLayanan', 'LIKE', "%$keyword%");
                        });
                });
            }

            $pesanan = $pesanan->orderBy('tanggalMasuk', 'desc')->get();

            return view('lihatDataPesanan.index.pelanggan', compact('pesanan', 'user'));
        }

        if ($role === 'kurir') {
            $user = Session::get('kurir');
            $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
                ->where('statusPesanan', 'Menunggu Pengantaran')
                ->orderBy('tanggalMasuk', 'desc')
                ->get();

            return view('lihatDataPesanan.index.kurir', compact('pesanan', 'user'));
        }

        if ($role === 'karyawan') {
            $user = Session::get('karyawan');
            $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
                ->orderBy('tanggalMasuk', 'desc');
            // ->get();

            // =====================================
            // FILTER STATUS
            // =====================================
            if (request('status')) {
                $pesanan->where('statusPesanan', request('status'));
            }

            // =====================================
            // FILTER TANGGAL MASUK
            // =====================================
            if (request('from')) {
                $pesanan->whereDate('tanggalMasuk', '>=', request('from'));
            }

            if (request('to')) {
                $pesanan->whereDate('tanggalMasuk', '<=', request('to'));
            }

            // Ambil hasil akhir query
            $pesanan = $pesanan->get();

            return view('lihatDataPesanan.index.karyawan', compact('pesanan', 'user'));
        }

        return redirect()->route('login.show')
            ->with('error', 'Role tidak valid.');
    }

    public function lihatDetail($id)
    {
        $role = Session::get('role');

        if (!$role) {
            return redirect()->route('login.show')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Session::get($role); // pelanggan, kurir, atau karyawan

        if (!$user) {
            return redirect()->route('login.show')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pesanan
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);

        // Authorization check
        if ($role === 'pelanggan' && $pesanan->idPelanggan !== $user->idPelanggan) {
            abort(403, 'Anda hanya bisa melihat pesanan sendiri.');
        }

        if ($role === 'kurir' && $pesanan->statusPesanan !== 'Menunggu Pengantaran') {
            abort(403, 'Kurir hanya bisa melihat pesanan yang menunggu pengantaran.');
        }

        // Return view detail berdasarkan role
        return view("lihatDataPesanan.detail.{$role}", compact('pesanan', 'user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $role = Session::get('role');

        if ($role !== 'karyawan' && $role !== 'kurir') {
            abort(403, 'Hanya Karyawan dan Kurir yang dapat memperbarui status pesanan.');
        }

        $user = Session::get($role);
        if (!$user) {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input status
        $validated = $request->validate([
            'statusPesanan' => 'required|string|in:Diproses,Menunggu Pengantaran,Sudah Diantar,Selesai'
        ]);

        // Cari pesanan
        $pesanan = Pesanan::findOrFail($id);

        // Kurir hanya boleh ubah dari "Menunggu Pengantaran" ke "Sudah Diantar"
        if ($role === 'kurir' && $pesanan->statusPesanan !== 'Menunggu Pengantaran') {
            abort(403, 'Kurir hanya bisa mengantarkan pesanan yang menunggu pengantaran.');
        }

        $pesanan->statusPesanan = $validated['statusPesanan'];
        $pesanan->save();

        return redirect()->route('lihatdata.detail', $id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
