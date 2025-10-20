<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'idPesanan';
    public $timestamps = false;

    protected $fillable = [
        'namaPesanan',
        'idPelanggan',
        'idLayanan',
        'idKurir',
        'idKaryawan',
        'statusPesanan',
        'alamat',
        'paket',
        'pakaian',
        'seprai',
        'handuk',
        'beratBarang',
        'tanggalMasuk',
        'tanggalSelesai',
        'totalHarga',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idPelanggan', 'idPelanggan');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'idKaryawan', 'idKaryawan');
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'idKurir', 'idKurir');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'idLayanan', 'idLayanan');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'idPesanan', 'idPesanan');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'idPesanan', 'idPesanan');
    }
}
