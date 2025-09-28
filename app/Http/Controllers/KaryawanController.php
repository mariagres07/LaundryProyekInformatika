<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    // Menampilkan semua karyawan
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.list', compact('karyawan'));
    }

    // Menampilkan form tambah karyawan
    public function create()
    {
        return view('karyawan.create');
    }

    // Proses simpan data karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:karyawan,username',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string|max:255',
            'noHp' => 'required|string|max:15',
        ]);

        Karyawan::create([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'password'     => Hash::make($request->password), // password dienkripsi
            'alamat'       => $request->alamat,
            'noHp'         => $request->noHp,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    // Menampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    // Proses update karyawan
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'namaKaryawan' => 'required|string|max:100',
            'username'     => 'required|string|max:50|unique:karyawan,username,' . $id . ',idKaryawan',
            'alamat'       => 'required|string|max:255',
            'noHp'         => 'required|string|max:15',
        ]);

        $data = [
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'alamat'       => $request->alamat,
            'noHp'         => $request->noHp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    // Hapus karyawan
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
