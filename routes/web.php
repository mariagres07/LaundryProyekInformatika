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

// ===================== AUTH / LOGIN =====================
Route::get('/masuk', [LoginController::class, 'showLogin'])->name('login.show');
Route::get('/daftar', [LoginController::class, 'showRegister'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register.process');

Route::get('/otp', [LoginController::class, 'showOtp'])->name('otp.show');
Route::post('/otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/berhasil', [LoginController::class, 'success'])->name('success');

// ===================== PELANGGAN =====================
Route::get('/editprofil', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/editprofil', [PelangganController::class, 'update'])->name('pelanggan.update');

// ===================== KARYAWAN =====================
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/karyawan/input', [KaryawanController::class, 'input']);
Route::post('/mkaryawan/simpan', [KaryawanController::class, 'store']);
Route::get('/mkaryawan/edit/{id}', [KaryawanController::class, 'edit']);
Route::put('/mkaryawan/update/{id}', [KaryawanController::class, 'update']);
Route::delete('/mkaryawan/hapus/{id}', [KaryawanController::class, 'destroy']);

// ===================== KURIR =====================
Route::get('/mkurir', [KurirController::class, 'index'])->name('kurir.index');
Route::get('/mkurir/input', [KurirController::class, 'create']);
Route::post('/mkurir/store', [KurirController::class, 'store']);
Route::get('/mkurir/edit/{idKurir}', [KurirController::class, 'edit']);
Route::put('/mkurir/update/{idKurir}', [KurirController::class, 'update']);
Route::delete('/mkurir/hapus/{idKurir}', [KurirController::class, 'hapus']);

// ===================== LAYANAN =====================
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

// ===================== PESAN LAUNDRY =====================
Route::get('/pesanLaundry', [PesanLaundryController::class, 'index'])->name('pesanLaundry');
Route::get('/detailPesanan', [PesanLaundryController::class, 'detail'])->name('detailPesanan');
Route::post('/checkout', [PesanLaundryController::class, 'checkout'])->name('checkout');

// ===================== LAPORAN DAN VERIFIKASI =====================
Route::get('/laporan', [ClihatLap::class, 'index'])->name('laporan.index');
Route::get('/lihatdata', [ClihatPesanan::class, 'index'])->name('lihatdata.index');
Route::get('/lihat-detail/{id}', [ClihatPesanan::class, 'lihatDetail'])->name('lihatDetail');

Route::get('/lihatverifikasi', [CVerifikasi::class, 'index'])->name('lihatverifikasi.index');
Route::get('/detailVer/{id}', [CVerifikasi::class, 'detail'])->name('detail');

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
Route::get('/pengaduan/{idPengaduan}', [TanggapiPengaduanController::class, 'show'])->name('pengaduan.show');
Route::post('/pengaduan/{idPengaduan}/tanggapan', [TanggapiPengaduanController::class, 'kirimTanggapan'])->name('pengaduan.kirim');
Route::post('/pengaduan/{idPengaduan}/selesai', [TanggapiPengaduanController::class, 'selesaikan'])->name('pengaduan.selesai');
