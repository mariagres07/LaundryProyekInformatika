<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('welcome');
//});


Route::get('/', function () {
    return view('login.index');
});

// Halaman index
Route::get('/index', function () {
    return view('login.index');
});

// Halaman login/masuk
Route::get('/masuk', function () {
    return view('login.masuk');
});

// Halaman daftar/registrasi
Route::get('/daftar', function () {
    return view('login.daftar');
});

Route::get('/berhasil', function () {
    return view('login.berhasil');
});

Route::get('/otp', function () {
    return view('login.otp');
});

// Verifikasi OTP (sementara langsung berhasil)
Route::post('/verifikasi-otp', function (\Illuminate\Http\Request $request) {
    $kode = implode('', $request->otp); // gabungkan input OTP
    if ($kode === "123456") { // contoh OTP benar
        return redirect('/berhasil');
    }
    return back()->withErrors(['otp' => 'Kode OTP salah!']);
});