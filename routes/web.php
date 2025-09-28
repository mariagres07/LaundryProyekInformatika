<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesanLaundryController;

// untuk pesanLaundry.blade.php
Route::get('/pesanLaundry', [PesanLaundryController::class, 'index'])->name('pesanLaundry');

// untuk detailPesanan.blade.php
Route::get('/detailPesanan', [PesanLaundryController::class, 'detail'])->name('detailPesanan');

// proses checkout (alamat + paket)
Route::post('/checkout', [PesanLaundryController::class, 'checkout'])->name('checkout');
