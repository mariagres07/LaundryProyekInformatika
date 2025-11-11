<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';   // nama tabel
    protected $primaryKey = 'idKurir'; // primary key
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'namaKurir',
        'username',
        'noHp',
        'password',
        'email',
        'alamat',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'idKurir');
    }
}
