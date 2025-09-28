<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClihatLap;

use App\Http\Controllers\KurirController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesanLaundryController;

// PELANGGAN
Route::get('/editprofil', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/editprofil', [PelangganController::class, 'update'])->name('pelanggan.update');

// KURIR
// Manajemen Kurir
Route::get('/mkurir', [KurirController::class, 'index'])->name('kurir.index');
Route::get('/mkurir/input', [KurirController::class, 'create']);
Route::post('/mkurir/store', [KurirController::class, 'store']);
Route::get('/mkurir/edit/{idKurir}', [KurirController::class, 'edit']);
Route::put('/mkurir/update/{idKurir}', [KurirController::class, 'update']);
Route::delete('/mkurir/hapus/{idKurir}', [KurirController::class, 'hapus']);

// ---- ROUTE KARYAWAN ----
Route::get('/mkaryawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/mkaryawan/input', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/mkaryawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/mkaryawan/edit/{idKaryawan}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/mkaryawan/update/{idKaryawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/mkaryawan/hapus/{idKaryawan}', [KaryawanController::class, 'confirmDelete'])->name('karyawan.confirmDelete');
Route::delete('/mkaryawan/destroy/{idKaryawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

// ---- ROUTE LAYANAN ----
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

// AUTH / LOGIN
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

// PESAN LAUNDRY
Route::get('/pesanLaundry', [PesanLaundryController::class, 'index'])->name('pesanLaundry');
Route::get('/detailPesanan', [PesanLaundryController::class, 'detail'])->name('detailPesanan');
Route::post('/checkout', [PesanLaundryController::class, 'checkout'])->name('checkout');

// LAPORAN
Route::get('/laporan', [ClihatLap::class, 'index'])->name('laporan.index');

// Halaman dashboard
Route::get('/tampilanKaryawan', function () {
    return view('dashboard.index');
});

