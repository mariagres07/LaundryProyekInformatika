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
        'judulPengaduan',
        'media',
        'tanggapanPengaduan',
        'statusPengaduan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idPelanggan', 'idPelanggan');
    }
}
