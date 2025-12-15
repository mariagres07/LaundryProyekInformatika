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

        // Jika session kosong, redirect ke login dengan pesan error
        if (!$id) {
            return redirect()->route('login.show')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pelanggan dari database
        $pelanggan = Pelanggan::find($id);

        // Jika data pelanggan tidak ditemukan, redirect kembali dengan error
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Kirim data ke view
        // return view('ManajemenAkun.editProfilPelanggan', compact('pelanggan'));
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
            'password' => [
                'nullable',
                'string',
                'min:8', // minimal 8 karakter
                'regex:/[A-Z]/', // ada huruf besar
                'regex:/[a-z]/', // ada huruf kecil
                'regex:/[0-9]/', // ada angka
                'regex:/[@$!%*?&#]/', // ada simbol spesial
            ],
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