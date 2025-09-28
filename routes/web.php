<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClihatLap;

//Route::get('/', function () {
    //return view('welcome');
//});

// Route :: get('/lihatLaporan', function (){
//     return view('LihatLaporan.lihatLaporan');
// });

Route::get('/laporan', [ClihatLap::class, 'index'])->name('laporan.index');