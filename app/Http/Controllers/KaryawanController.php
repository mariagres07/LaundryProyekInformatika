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
            'password' => [
                'required',
                'string',
                'min:8', // minimal 8 karakter
                'regex:/[A-Z]/', // ada huruf besar
                'regex:/[a-z]/', // ada huruf kecil
                'regex:/[0-9]/', // ada angka
                'regex:/[@$!%*?&#]/', // ada simbol spesial
                'confirmed'
            ],
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

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil disimpan!');
    }

    // Form edit
    public function edit(Karyawan $karyawan)
    {
        return view('ManajemenAkun.editKaryawan', compact('karyawan'));
    }

    //  Update data
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50|unique:karyawan,username,' . $karyawan->idKaryawan . ',idKaryawan',
            'noHp'         => 'required|string|max:15',
            'email'        => 'required|email|unique:karyawan,email,' . $karyawan->idKaryawan . ',idKaryawan',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
                'confirmed'
            ],
            'alamat'       => 'required|string'
        ]);

        $karyawan->update([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'noHp'         => $request->noHp,
            'email'        => $request->email,
            'alamat'       => $request->alamat,
        ]);

        // ✅ Update password hanya jika diisi
        if ($request->filled('password')) {
            $karyawan->password = Hash::make($request->password);
            $karyawan->save();
        }

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil diperbarui!');
    }
    // hapus data
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil dihapus!');
    }
}
