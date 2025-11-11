<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{

    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'idPelanggan';
    public $timestamps = false;

    protected $fillable = [
        'namaPelanggan',
        'username',
        'password',
        'email',
        'alamat',
        'noHp',
        'otp',
        'otp_expires_at',
        'is_verified',

    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'idPelanggan');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'idPelanggan');
    }
}