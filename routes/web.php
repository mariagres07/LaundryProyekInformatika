<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClihatLap;
use App\Http\Controllers\ClihatPesanan;
use App\Http\Controllers\CVerifikasi;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesanLaundryController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Cdashboard;
use App\Http\Controllers\BuatPengaduanController;
use App\Http\Controllers\TanggapiPengaduanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;

// Route untuk halaman utama (landing page)
Route::get('/', [LandingController::class, 'index'])->name('landing.index');


// ===================== AUTH / LOGIN =====================
Route::get('/masuk', [LoginController::class, 'showLogin'])->name('login.show');
Route::post('/masuk', [LoginController::class, 'login'])->name('login.process');
Route::get('/daftar', [LoginController::class, 'showRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.process');

Route::get('/otp', [LoginController::class, 'showOtp'])->name('otp.show');
Route::post('/otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/berhasil', [LoginController::class, 'success'])->name('success');

// ========LOGOUT========
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===================== PELANGGAN =====================
Route::get('/editprofil', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/editprofil', [PelangganController::class, 'update'])->name('pelanggan.update');

// ===================== KARYAWAN =====================
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/hapus/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

// ===================== KURIR =====================
Route::get('/mkurir', [KurirController::class, 'index'])->name('kurir.index');
Route::get('/mkurir/input', [KurirController::class, 'create']);
Route::post('/mkurir/store', [KurirController::class, 'store']);
Route::get('/mkurir/edit/{idKurir}', [KurirController::class, 'edit']);
Route::put('/mkurir/update/{idKurir}', [KurirController::class, 'update']);
Route::delete('/mkurir/hapus/{idKurir}', [KurirController::class, 'hapus']);

// ===================== LAYANAN =====================
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');

// Kategori
Route::post('/kategori', [LayananController::class, 'storeKategori'])->name('kategori.store');
Route::put('/kategori/{id}', [LayananController::class, 'updateKategori'])->name('kategori.update');
Route::delete('/kategori/{id}', [LayananController::class, 'destroyKategori'])->name('kategori.destroy');

// Layanan
Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

// ===================== PESAN LAUNDRY =====================
Route::get('/pesanLaundry', [PesanLaundryController::class, 'index'])->name('pesanLaundry');
Route::get('/detailPesanan/{id}', [PesanLaundryController::class, 'detail'])->name('detailPesanan');
Route::post('/checkout', [PesanLaundryController::class, 'checkout'])->name('checkout');

// ===================== LAPORAN DAN VERIFIKASI =====================
Route::get('/laporan', [ClihatLap::class, 'index'])->name('laporan.index');
Route::get('/lihatdata', [ClihatPesanan::class, 'index'])->name('lihatdata.index');
Route::get('/lihat-detail/{id}', [ClihatPesanan::class, 'lihatDetail'])->name('lihatDetail');

Route::get('/lihatverifikasi', [CVerifikasi::class, 'index'])->name('lihatverifikasi.index');
Route::get('/detailVer/{id}', [CVerifikasi::class, 'detail'])->name('detail');
Route::post('/verifikasi/perhitungan/{id}', [CVerifikasi::class, 'perhitungan'])->name('verifikasi.perhitungan');

// ===================== DASHBOARD =====================
Route::get('/tampilanKaryawan', [Cdashboard::class, 'tampilanKaryawan'])->name('dashboard.karyawan');
Route::get('/tampilanKurir', [Cdashboard::class, 'tampilanKurir'])->name('dashboard.kurir');
Route::get('/tampilanPelanggan', [Cdashboard::class, 'tampilanPelanggan'])->name('dashboard.pelanggan');

// ===================== PENGADUAN =====================
// Buat Pengaduan
Route::get('/pengaduan/buat', [BuatPengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [BuatPengaduanController::class, 'store'])->name('pengaduan.store');

// Tanggapi Pengaduan
Route::get('/pengaduan', [TanggapiPengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/{id}', [TanggapiPengaduanController::class, 'show'])->name('pengaduan.show');
Route::post('/pengaduan/{id}/kirim', [TanggapiPengaduanController::class, 'kirimTanggapan'])->name('pengaduan.kirim');
Route::post('/pengaduan/{id}/selesai', [TanggapiPengaduanController::class, 'selesaikan'])->name('pengaduan.selesai');