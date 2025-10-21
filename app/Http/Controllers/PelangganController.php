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

        // Jika session kosong, tampilkan pesan error langsung
        if (!$id) {
            return back()->with('error', 'Data pelanggan tidak ditemukan atau belum login.');
        }

        // Ambil data pelanggan dari database
        $pelanggan = Pelanggan::find($id);

        // Jika data pelanggan tidak ditemukan di database
        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Kirim data ke view
        return view('ManajemenAkun.editProfilPelanggan', compact('pelanggan'));
    }

    public function update(Request $request)
    {
        $id = session('idPelanggan');

        $request->validate([
            'namaPelanggan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pelanggan,username,' . $id . ',idPelanggan',
            'noHp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email,' . $id . ',idPelanggan',
            'password' => 'nullable|min:6',
        ]);

        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Update data
        $pelanggan->namaPelanggan = $request->namaPelanggan;
        $pelanggan->username = $request->username;
        $pelanggan->noHp = $request->noHp;
        $pelanggan->email = $request->email;

        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
