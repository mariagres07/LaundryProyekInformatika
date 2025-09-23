<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';
    protected $primaryKey = 'idKurir';
    public $timestamps = false;

    protected $fillable = [
        'namaKurir',
        'noHp',
        'alamat',
    ];

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'idKurir');
    }
}
