<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'idKaryawan';
    public $timestamps = false;

    protected $fillable = [
        'namaKaryawan',
        'username',
        'password',
        'alamat',
        'email',
        'noHp',
    ];
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'idKaryawan');
    }
}