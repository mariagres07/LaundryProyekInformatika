<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Halaman index
    public function index()
    {
        return view('login.index');
    }

    // Form login
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

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return redirect()->route('otp.show');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // Form register
    public function showRegister()
    {
        return view('login.daftar');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        return redirect()->route('otp.show');
    }

    // Form OTP
    public function showOtp()
    {
        return view('login.otp');
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $kode = implode('', $request->otp); 

        if ($kode === "123456") {
            return redirect()->route('success');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah!']);
    }

    // Halaman sukses
    public function success()
    {
        return view('login.berhasil');
    }
}
