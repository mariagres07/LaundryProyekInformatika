<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detailTransaksi';
    protected $primaryKey = 'idDetailTransaksi';
    public $timestamps = false;

    protected $fillable = [
        'idPesanan',
        'idKategoriItem',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idPesanan', 'idPesanan');
    }

    public function kategoriItem()
    {
        return $this->belongsTo(KategoriItem::class, 'idKategoriItem', 'idKategoriItem');
    }

    public function transaksiPembayaran()
    {
        return $this->belongsTo(TransaksiPembayaran::class, 'idDetailTransaksi', 'idDetailTransaksi');
    }
}
