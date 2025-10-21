<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function edit()
    {
        // Ambil ID pelanggan dari session
        $id = session('idPelanggan');

        // Cegah error kalau session kosong
        if (!$id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pelanggan dari database
        $pelanggan = Pelanggan::find($id);

        // Pastikan data ditemukan
        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        return view('ManajemenAkun.editProfilPelanggan', compact('pelanggan'));
    }

    public function update(Request $request)
    {
        $id = session('idPelanggan');

        // Validasi input
        $request->validate([
            'namaPelanggan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pelanggan,username,' . $id . ',idPelanggan',
            'noHp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email,' . $id . ',idPelanggan',
            'password' => 'nullable|min:6',
        ]);

        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Update data
        $pelanggan->namaPelanggan = $request->namaPelanggan;
        $pelanggan->username = $request->username;
        $pelanggan->noHp = $request->noHp;
        $pelanggan->email = $request->email;

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
