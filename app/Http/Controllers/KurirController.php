<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;
use Illuminate\Support\Facades\Hash;

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
            'alamat'    => 'required|string',
        ]);

        Kurir::create([
            'namaKurir' => $request->namaKurir,
            'username'  => $request->username,
            'noHp'      => $request->noHp,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'alamat'    => $request->alamat,
        ]);

        return redirect('/mkurir')->with('success', 'Kurir berhasil ditambahkan!');
    }

    // Halaman form edit kurir
    public function edit(Kurir $kurir)
    {
        // $kurir = Kurir::findOrFail($idKurir);
        return view('ManajemenAkun.editKurir', compact('kurir'));
    }

    // Update data kurir
    public function update(Request $request, Kurir $kurir)
    {
        $request->validate([
            'namaKurir' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:kurir,username,' . $kurir->idKurir . ',idKurir',
            'noHp'      => 'required|string|max:15',
            'email'     => 'required|email|unique:kurir,email,' . $kurir->idKurir . ',idKurir',
            'password'  => [
                'nullable',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
            'alamat'    => 'required|string',
        ]);

        $kurir->update([
            'namaKurir' => $request->namaKurir,
            'username'  => $request->username,
            'noHp'      => $request->noHp,
            'email'     => $request->email,
            'alamat'    => $request->alamat,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $kurir->password = Hash::make($request->password);
            $kurir->save();
        }

        return redirect('/mkurir')->with('success', 'Data kurir berhasil diperbarui!');
    }

    // Hapus kurir
    public function hapus($idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);
        // jika ada relasi yang mencegah penghapusan, tangani relasi tersebut sebelum delete
        $kurir->delete();
        return redirect('/mkurir')->with('success', 'Kurir berhasil dihapus!');
    }
}
