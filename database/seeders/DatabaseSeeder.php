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
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('password123'),
            'email' => 'kurir1@gmail.com',
        ]);

        $pelanggan = Pelanggan::create([
            'namaPelanggan' => 'Pelanggan 1',
            'username' => 'pelanggan1',
            'password' => Hash::make('password123'),
            'email' => 'pelanggan@gmail.com',
            'otp' => now(),
            'alamat' => 'Jl. Pelanggan No. 1',
            'noHp' => '081234567892',
        ]);

        $karyawan = Karyawan::create([
            'namaKaryawan' => 'Karyawan 1',
            'username' => 'karyawan1',
            'password' => Hash::make('karyawan1234'),
            'alamat' => 'Jl. Karyawan No. 1',
            'noHp' => '081234567890',
            'email' => 'karyawan1@gmail.com',
        ]);

        // === Layanan (4 jenis) ===
        $layananList = [
            ['namaLayanan' => 'Express (Vanilla)', 'hargaPerKg' => 10000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Express', 'hargaPerKg' => 9000, 'estimasiHari' => 2],
            ['namaLayanan' => 'Reguler (Vanilla)', 'hargaPerKg' => 8000, 'estimasiHari' => 4],
            ['namaLayanan' => 'Reguler', 'hargaPerKg' => 7000, 'estimasiHari' => 4],
        ];

        foreach ($layananList as $data) {
            Layanan::create($data);
        }

        $layanan = Layanan::first();

        // === Pesanan ===
        $pesanan = Pesanan::create([
            'namaPesanan' => 'Pesanan 1',
            'idPelanggan' => $pelanggan->idPelanggan,
            'idLayanan' => $layanan->idLayanan,
            'idKurir' => $kurir->idKurir,
            'idKaryawan' => $karyawan->idKaryawan,
            'statusPesanan' => 'Menunggu Penjemputan',
            'alamat' => 'Jl. Pelanggan No. 1',
            'paket' => 'Paket A',
            'pakaian' => 3,
            'seprai' => 2,
            'handuk' => 1,
            'tanggalMasuk' => now(),
        ]);

        $kategoriData = [
            ['namaKategori' => 'Pakaian', 'jumlahItem' => 3, 'hargaPerItem' => 5000],
            ['namaKategori' => 'Seprai', 'jumlahItem' => 2, 'hargaPerItem' => 7000],
            ['namaKategori' => 'Handuk', 'jumlahItem' => 1, 'hargaPerItem' => 6000],
            ['namaKategori' => 'Jas', 'jumlahItem' => 1, 'hargaPerItem' => 10000],
        ];

        foreach ($kategoriData as $data) {
            KategoriItem::create($data);
        }

        $kategori = KategoriItem::first();

        $detail = DetailTransaksi::create([
            'idPesanan' => $pesanan->idPesanan,
            'idKategoriItem' => $kategori->idKategoriItem,
            'jumlahKategori' => 3,
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
            'statusPengaduan' => 'Belum Ditanggapi',
            'tanggapanPengaduan' => 'Mohon maaf atas ketidaknyamanannya, kami akan mencari pakaian Anda secepatnya.',
        ]);
    }
}
