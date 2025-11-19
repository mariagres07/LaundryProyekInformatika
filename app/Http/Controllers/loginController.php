<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use App\Models\Kurir;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Tampilkan Form login
    public function showLogin()
    {
        return view('login.masuk');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek tabel pelanggan
        $pelanggan = Pelanggan::where('email', $request->email)->first();
        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            Session::put('idPelanggan', $pelanggan->idPelanggan);
            Session::put('pelanggan', $pelanggan);
            Session::put('role', 'pelanggan');
            return redirect()->route('dashboard.pelanggan');
        }

        // Cek tabel kurir
        $kurir = Kurir::where('email', $request->email)->first();
        if ($kurir && Hash::check($request->password, $kurir->password)) {
            Session::put('kurir', $kurir);
            Session::put('role', 'kurir');
            return redirect()->route('dashboard.kurir');
        }

        // Cek tabel karyawan
        $karyawan = Karyawan::where('email', $request->email)->first();
        if ($karyawan && Hash::check($request->password, $karyawan->password)) {
            Session::put('karyawan', $karyawan);
            Session::put('role', 'karyawan');
            return redirect()->route('karyawan.dashboard');
        }

        // Jika tidak cocok dengan siapa pun
        return back()->withErrors(['login_error' => 'Email atau password salah!']);
    }

    // Proses logout
    public function logout()
    {
        Session::flush(); // hapus semua data session
        return redirect()->route('login.show')->with('success', 'Berhasil keluar.');
    }
}