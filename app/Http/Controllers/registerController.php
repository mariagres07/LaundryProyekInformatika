<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;

class registerController extends Controller
{
    // Form register pelanggan
    public function showRegister()
    {
        return view('login.daftar');
    }

    // Proses register pelanggan dengan OTP
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'namaPelanggan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pelanggan,username',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|unique:pelanggan,email',
        ]);

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan pelanggan beserta OTP
        $pelanggan = Pelanggan::create([
            'namaPelanggan' => $request->namaPelanggan,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => '',
            'noHp' => '',
            'otp' => $otp, // Simpan OTP di database
            'otp_expires_at' => now()->addMinutes(5), // OTP berlaku 5 menit
        ]);

        // Simpan OTP di session supaya bisa ditampilkan di web
        session([
            'otp' => $otp,
            'pelanggan_id' => $pelanggan->idPelanggan
        ]);

        return redirect()->route('otp.show')
            ->with('success', 'OTP telah dibuat. Lihat di halaman ini!');
    }

    // Tampilkan halaman OTP
    public function showOtp()
    {
        return view('login.otp');
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|digits:1'
        ]);

        $kode = implode('', $request->otp);
        $pelanggan = Pelanggan::find(session('pelanggan_id'));

        if (!$pelanggan) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Pelanggan tidak ditemukan.']);
        }

        // Cek OTP dan waktu kadaluarsa
        if ($pelanggan->otp == $kode && $pelanggan->otp_expires_at >= now()) {
            // OTP valid → hapus OTP
            $pelanggan->otp = null;
            $pelanggan->otp_expires_at = null;
            $pelanggan->save();

            // Bisa login otomatis atau redirect ke halaman sukses
            return redirect()->route('success')->with('success', 'Akun berhasil diverifikasi!');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah expired!']);
    }

    // Halaman sukses setelah OTP valid
    public function success()
    {
        return view('login.berhasil');
    }
}