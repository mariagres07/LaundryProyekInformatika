<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PelangganController extends Controller
{
    public function edit()
    {
        $pela = auth()->user(); // data user login
        return view('editProfilPelanggan', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:6',
        ]);

        $user = auth()->user();
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('pelanggan.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
