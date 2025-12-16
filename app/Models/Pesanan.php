<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'idPesanan';
    public $timestamps = true;

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

    public function ubahStatus($statusBaru)
    {
        // Daftar status valid untuk menjaga konsistensi data
        $statusValid = [
            'Menunggu Penjemputan',
            'Sedang Diproses',
            'Menunggu Pengantaran',
            'Sudah Diantar',
            'Selesai',
            'Dibatalkan',
        ];

        if (!in_array($statusBaru, $statusValid)) {
            throw new \InvalidArgumentException('Status pesanan tidak valid.');
        }

        $statusLama = $this->statusPesanan;

        // Update status
        $this->statusPesanan = $statusBaru;
        $this->save();

        // (Opsional) Simpan log perubahan status
        if (method_exists($this, 'logStatus')) {
            $this->logStatus()->create([
                'statusLama' => $statusLama,
                'statusBaru' => $statusBaru,
                'idKaryawan' => auth()->user()->idKaryawan ?? null, // kalau ada autentikasi Laravel
                'waktuPerubahan' => now(),
            ]);
        }
    }
    public function transaksiPembayaran()
    {
        return $this->hasOneThrough(
            TransaksiPembayaran::class,
            DetailTransaksi::class,
            'idPesanan',          // FK di DetailTransaksi
            'idDetailTransaksi',  // FK di TransaksiPembayaran
            'idPesanan',          // PK di Pesanan
            'idDetailTransaksi'   // PK di DetailTransaksi
        );
    }
}