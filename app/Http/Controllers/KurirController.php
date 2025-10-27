<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;
use App\Models\Layanan;;

use App\Models\Pesanan;

class KurirController extends Controller
{
    // Halaman daftar kurir
    public function index()
    {
        $kurir = Kurir::all(); // ambil semua kurir
        return view('ManajemenAkun.manajemenKurir', compact('kurir'));
    }

    // Halaman form input kurir baru
    public function create()
    {
        return view('ManajemenAkun.inputKurir');
    }

    // Simpan data kurir baru
    public function store(Request $request)
    {
        $request->validate([
            'namaKurir' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:kurir,username',
            'noHp'      => 'required|string|max:15',
            'email'     => 'required|email|unique:kurir,email',
            'password'  => 'required|min:6',
            'alamat'    => 'required|string',
        ]);

        Kurir::create([
            'namaKurir' => $request->namaKurir,
            'username'  => $request->username,
            'noHp'      => $request->noHp,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'alamat'    => $request->alamat,
        ]);

        return redirect('/mkurir')->with('success', 'Kurir berhasil ditambahkan!');
    }

    // Halaman form edit kurir
    public function edit($idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);
        return view('ManajemenAkun.editKurir', compact('kurir'));
    }

    // Update data kurir
    public function update(Request $request, $idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);

        $request->validate([
            'namaKurir' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:kurir,username,' . $idKurir . ',idKurir',
            'noHp'      => 'required|string|max:15',
            'email'     => 'required|email|unique:kurir,email,' . $idKurir . ',idKurir',
            'password'  => 'nullable|min:6',
            'alamat'    => 'required|string',
        ]);

        $kurir->namaKurir = $request->namaKurir;
        $kurir->username  = $request->username;
        $kurir->noHp      = $request->noHp;
        $kurir->email     = $request->email;
        $kurir->alamat    = $request->alamat;

        if ($request->filled('password')) {
            $kurir->password = bcrypt($request->password);
        }

        $kurir->save();

        return redirect('/mkurir')->with('success', 'Data kurir berhasil diperbarui!');
    }

    // Hapus kurir
    public function hapus($idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);
        $kurir->delete();

        return redirect('/mkurir')->with('success', 'Kurir berhasil dihapus!');
    }

    public function konfirmasiBerat(Request $request, $idPesanan)
    {
        $request->validate([
            'beratBarang' => 'required|numeric|min:0.1',
        ]);

        // Ambil data pesanan
        $pesanan = Pesanan::findOrFail($idPesanan);

        // Ambil harga per kg dari layanan terkait
        $layanan = Layanan::findOrFail($pesanan->idLayanan);

        // Hitung total harga
        $totalHarga = $request->beratBarang * $layanan->hargaPerKg;

        // Update data pesanan
        $pesanan->update([
            'beratBarang'    => $request->beratBarang,
            'totalHarga'     => $totalHarga,
            'statusPesanan'  => 'Menunggu Pembayaran', // setelah ditimbang
        ]);

        return redirect()->back()->with('success', 'Berat dan total harga berhasil dikonfirmasi.');
    }
}
