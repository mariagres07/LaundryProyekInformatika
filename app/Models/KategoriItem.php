<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriItem extends Model
{
    use HasFactory;

    protected $table = 'kategoriItem';
    protected $primaryKey = 'idKategoriItem';
    public $timestamps = true;

    protected $fillable = [
        'namaKategori',
        'jumlahItem',
        'hargaPerItem',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'idKategoriItem');
    }
}
