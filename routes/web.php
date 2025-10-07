<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClihatLap;
use App\Http\Controllers\ClihatPesanan;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesanLaundryController;
use App\Http\Controllers\KaryawanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\BuatPengaduanController;
use App\Http\Controllers\TanggapiPengaduanController;

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
Route::resource('karyawan', KaryawanController::class);
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
Route::get('/lihatdata', [ClihatPesanan::class, 'index'])->name('lihatdata.index');
Route::get('/lihat-detail/{id}', [ClihatPesanan::class, 'lihatDetail'])->name('lihatDetail');

// Halaman dashboard
Route::get('/tampilanKaryawan', [DashboardKaryawanController::class, 'tampilanKaryawan'])->name('tampilanKaryawan');
// Route::get('/tampilanKurir', [DahboardKurirController::class, 'tampilanKurir'])->name('tampilanKurir');
// Route::get('/tampilanPelanggan', [DashboardPelangganController::class, 'tampilanPelanggan'])->name('tampilanPelanggan');

//Buat Pengaduan
// Rute untuk menampilkan formulir pengaduan (GET request)
Route::get('/pengaduan/buat', [BuatPengaduanController::class, 'create'])->name('pengaduan.create');
// Rute untuk memproses pengiriman formulir pengaduan (POST request)
Route::post('/pengaduan', [BuatPengaduanController::class, 'store'])->name('pengaduan.store');