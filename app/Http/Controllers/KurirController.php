<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;

class KurirController extends Controller
{
    public function index()
    {
        $kurirs = Kurir::all();
        return view('kurir.index', compact('kurirs'));
    }

    public function create()
    {
        return view('kurir.input');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKurir' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:kurirs,username',
            'noHp'      => 'required|string|max:15',
            'email'     => 'required|email|unique:kurirs,email',
            'password'  => 'required|min:6',
            'alamat'    => 'required|string',
        ]);

        Kurir::create([
            'namaKurir' => $request->namaKurir,
            'username'  => $request->username,
            'noHp'      => $request->noHp,
            'email'     => $request->email,
            'password'  => bcrypt($request->password), // hash password
            'alamat'    => $request->alamat,
        ]);

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil ditambahkan!');
    }

    public function edit($idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);
        return view('kurir.edit', compact('kurir'));
    }

    public function update(Request $request, $idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);

        $request->validate([
            'namaKurir' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:kurirs,username,' . $kurir->idKurir . ',idKurir',
            'noHp'      => 'required|string|max:15',
            'email'     => 'required|email|unique:kurirs,email,' . $kurir->idKurir . ',idKurir',
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

        return redirect()->route('kurir.index')->with('success', 'Data kurir berhasil diperbarui!');
    }

    public function hapus($idKurir)
    {
        $kurir = Kurir::findOrFail($idKurir);
        $kurir->delete();
        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil dihapus!');
    }
}
