<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    // Tampilkan daftar semua karyawan
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('ManajemenAkun.manajemenKaryawan', compact('karyawan'));
    }

    // Tampilkan form tambah karyawan
    public function create()
    {
        return view('ManajemenAkun.tambahKaryawan');
    }

    // Simpan data karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50',
            'noHp'         => 'required|string|max:15',
            'email'        => 'required|email',
            'password'     => 'required|string|min:6',
            'alamat'       => 'required|string'
        ]);

        Karyawan::create([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'noHp'         => $request->noHp,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'alamat'       => $request->alamat,
        ]);

        return redirect('/mkaryawan')->with('success', 'Data karyawan berhasil disimpan!');
    }

    // Tampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('ManajemenAkun.editKaryawan', compact('karyawan'));
    }

    // Update data karyawan
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50',
            'noHp'         => 'required|string|max:15',
            'email'        => 'required|email',
            'password'     => 'required|string|min:6',
            'alamat'       => 'required|string'
        ]);

        $karyawan->update([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'noHp'         => $request->noHp,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'alamat'       => $request->alamat,
        ]);

        return redirect('/karyawan')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Hapus data karyawan
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect('/karyawan')->with('success', 'Data karyawan berhasil dihapus!');
    }
}
