<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'transaksiPembayaran';
    protected $primaryKey = 'idTransaksiPembayaran';
    public $timestamps = false;

    protected $fillable = [
        'idDetailTransaksi',
        'metodePembayaran',
        'tanggalPembayaran',
        'totalPembayaran',
    ];

    public function pesanan()
    {
        return $this->belongsTo(DetailTransaksi::class, 'idDetailTransaksi');
    }
}
