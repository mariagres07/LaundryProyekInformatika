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

    //  Form tambah karyawan baru
    public function create()
    {
        return view('ManajemenAkun.tambahKaryawan');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50|unique:karyawan,username',
            'noHp'         => 'required|string|max:15',
            'email'        => 'required|email|unique:karyawan,email',
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

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan!');
    }

    // Form edit
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('ManajemenAkun.editKaryawan', compact('karyawan'));
    }

    //  Update data
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50',
            'noHp'         => 'required|string|max:15',
            'email'        => 'required|email',
            'alamat'       => 'required|string'
        ]);

        // Jika user mengganti password
        if ($request->filled('password')) {
            $karyawan->password = Hash::make($request->password);
        }

        $karyawan->update([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'noHp'         => $request->noHp,
            'email'        => $request->email,
            'alamat'       => $request->alamat,
        ]);

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // hapus data
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil dihapus!');
    }
}
