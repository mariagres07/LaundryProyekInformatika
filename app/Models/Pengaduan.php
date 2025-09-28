<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'idPengaduan';
    public $timestamps = false;

    protected $fillable = [
        'idPelanggan',
        'idPesanan',
        'tanggalPengaduan',
        'deskripsi',
        //'judul',
        //'file_path',
        //'tanggapan karyawan',

    ];

     public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idPelanggan');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idPesanan');
    }

}