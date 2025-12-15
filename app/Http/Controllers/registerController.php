<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('login.daftar');
    }

    // ===================== REGISTER =====================
    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'namaPelanggan' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:pelanggan,username',
                'email' => 'required|email|unique:pelanggan,email',
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
                'alamat' => 'nullable|string|max:500',
                'noHp' => 'nullable|string|max:13',
            ],
            [
                'password.min' => 'Password minimal 8 karakter.',
                'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]
        );

        $otp = rand(100000, 999999);

        // Simpan akun baru dalam status belum terverifikasi
        $pelanggan = Pelanggan::create([
            'namaPelanggan'  => $validated['namaPelanggan'],
            'username'       => $validated['username'],
            'email'          => $validated['email'],
            'password'       => Hash::make($validated['password']),
            'alamat'         => $validated['alamat'],
            'noHp'           => $validated['noHp'],
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'is_verified'    => false,
        ]);

        // Simpan session agar OTP bisa muncul
        session(['pelanggan_id' => $pelanggan->idPelanggan]);

        return redirect()->route('otp.show');
    }

    // ===================== TAMPILKAN OTP =====================
    public function showOtp()
    {
        $pelanggan = Pelanggan::find(session('pelanggan_id'));

        if (!$pelanggan) {
            return redirect()->route('register.show')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Jika OTP masih berlaku, tampilkan
        if (now()->lessThan($pelanggan->otp_expires_at) && !$pelanggan->is_verified) {
            $otp = $pelanggan->otp;
            $expiresAt = $pelanggan->otp_expires_at;
            return view('login.otp', compact('otp', 'expiresAt'));
        }

        // Kalau OTP kadaluarsa
        return redirect()->route('register.show')->with('error', 'Kode OTP sudah kedaluwarsa. Silakan daftar ulang.');
    }

    // ===================== VERIFIKASI OTP =====================
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|digits:1',
        ]);

        $kode = implode('', $request->otp);
        $pelanggan = Pelanggan::find(session('pelanggan_id'));

        if (!$pelanggan) {
            return redirect()->route('register.show')->with('error', 'Pelanggan tidak ditemukan.');
        }

        if (now()->greaterThan($pelanggan->otp_expires_at)) {
            return back()->with('error', 'Kode OTP sudah kedaluwarsa.');
        }

        if ($pelanggan->otp !== $kode) {
            return back()->with('error', 'Kode OTP salah.');
        }

        // OTP benar
        $pelanggan->update([
            'otp' => null,
            'otp_expires_at' => null,
            'is_verified' => true,
        ]);

        Session::forget('pelanggan_id');

        return redirect()->route('login.show')->with('success', 'Akun berhasil diverifikasi! Silakan login.');
    }

    public function success()
    {
        return view('login.berhasil');
    }
}
