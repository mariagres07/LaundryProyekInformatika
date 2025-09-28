<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Kurir;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\KategoriItem;
use App\Models\DetailTransaksi;
use App\Models\TransaksiPembayaran;
use App\Models\Pengaduan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kurir = Kurir::create([
            'namaKurir' => 'Kurir 1',
            'noHp' => '081234567891',
            'alamat' => 'Jl. Kurir No. 1',
            'username' => 'kurir1',
            'password' => bcrypt('password123'),
            'email' => 'kurir1@gmail.com',
        ]);

        $pelanggan = Pelanggan::create([
            'namaPelanggan' => 'Pelanggan 1',
            'username' => 'pelanggan1',
            'password' => bcrypt('password123'),
            'email' => 'pelanggan@gmail.com',
            'otp' => now(),
            'alamat' => 'Jl. Pelanggan No. 1',
            'noHp' => '081234567892',
        ]);

        $karyawan = Karyawan::create([
            'namaKaryawan' => 'Karyawan 1',
            'username' => 'karyawan1',
            'password' => bcrypt('password123'),
            'alamat' => 'Jl. Karyawan No. 1',
            'noHp' => '081234567890',
            'email' => 'karyawan1@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $layanan = Layanan::create([
            'namaLayanan' => 'Express(Vanilla)',
            'hargaPerKg' => 10000,
            'estimasiHari' => 2,
        ]);

        $pesanan = Pesanan::create([
            'namaPesanan' => 'Pesanan 1',
            'idPelanggan' => $pelanggan->idPelanggan,
            'idLayanan' => $layanan->idLayanan,
            'idKurir' => $kurir->idKurir,
            'idKaryawan' => $karyawan->idKaryawan,
            'statusPesanan' => false,
            'tanggalMasuk' => now(),
            'tanggalSelesai' => now()->addDays(2),
            'totalHarga' => 15000,
        ]);

        $kategori = KategoriItem::create([
            'namaKategori' => 'Pakaian',
            'jumlahItem' => 3,
        ]);

        $detail = DetailTransaksi::create([
            'idPesanan' => $pesanan->idPesanan,
            'idKategoriItem' => $kategori->idKategoriItem,
        ]);

        TransaksiPembayaran::create([
            'idDetailTransaksi' => $detail->idDetailTransaksi,
            'metodePembayaran' => 'Transfer Bank',
            'tanggalPembayaran' => now(),
            'totalPembayaran' => 15000,
        ]);
        Pengaduan::create([
            'idPelanggan' => $pelanggan->idPelanggan,
            'idPesanan' => $pesanan->idPesanan,
            'tanggalPengaduan' => now(),
            'deskripsi' => 'Pakaian saya ada yang hilang',
            'judulPengaduan' => 'Pakaian hilang',
            'media' => '',
            'tanggapanPengaduan' => 'Mohon maaf atas ketidaknyamanannya, kami akan mencari pakaian Anda secepatnya.',
        ]);
    }
}
