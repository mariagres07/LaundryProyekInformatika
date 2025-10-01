<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $karyawan = Karyawan::when($cari, function ($query, $cari) {
            return $query->where('namaKaryawan', 'like', "%$cari%")
                         ->orWhere('username', 'like', "%$cari%");
        })->get();

        return view('ManajemenAkun.manajemenKaryawan', compact('karyawan', 'cari'));
    }

    public function create()
    {
        return view('ManajemenAkun.createKaryawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKaryawan' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:karyawan',
            'password'     => 'required|string|min:6',
            'alamat'       => 'required|string',
            'noHp'         => 'required|string|max:20',
        ]);

        Karyawan::create([
            'namaKaryawan' => $request->namaKaryawan,
            'username'     => $request->username,
            'password'     => bcrypt($request->password),
            'alamat'       => $request->alamat,
            'noHp'         => $request->noHp,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('ManajemenAkun.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'namaKaryawan' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:karyawan,username,' . $id,
            'password'     => 'nullable|string|min:6',
            'alamat'       => 'required|string',
            'noHp'         => 'required|string|max:20',
        ]);

        $data = $request->only(['namaKaryawan', 'username', 'alamat', 'noHp']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $karyawan->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus');
    }
}
