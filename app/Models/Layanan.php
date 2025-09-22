<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'idLayanan';
    public $timestamps = false;

    protected $fillable = [
        'namaLayanan',
        'harga',
        'estimasiWaktu',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'idLayanan');
    }
}