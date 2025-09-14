<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        kurir::factory()->create([
            // 'idKurir' => 1,
            'namaKurir' => 'Kurir 1',
            'noHp' => '081234567891',
            'alamat' => 'Jl. Kurir No. 1',
        ]);

        pelanggan::factory()->create([
            // 'idPelanggan' => 1,
            'namaPelanggan' => 'Pelanggan 1',
            'username' => 'pelanggan1',
            'password' => bcrypt('password123'),
            'email' => 'pelanggan@gmail.com',    
            'otp' => now(),
            'alamat' => 'Jl. Pelanggan No. 1',
            'noHp' => '081234567892',
        ]);

        karyawan::factory()->create([
            // 'idKaryawan' => 1,
            'namaKaryawan' => 'Karyawan 1',
            'username' => 'karyawan1',
            'password' => bcrypt('password123'),
            'alamat' => 'Jl. Karyawan No. 1',
            'noHp' => '081234567890',
        ]);

        layanan::factory()->create([
            // 'idLayanan' => 1,
            'namaLayanan' => 'Cuci Kering',
            'hargaPerKg' => 5000,
            'estimasiHari' => 2,
        ]);

        pesanan::factory()->create([
            // 'idPesanan' => 1,
            'namaPesanan' => 'Pesanan 1',
            'idPelanggan' => 1,
            'idLayanan' => 1,
            'idKurir' => 1,
            'idKaryawan' => 1,
            'statusPesanan' => false,
            'tanggalMasuk' => now(),
            'tanggalSelesai' => now()->addDays(2),
            'totalHarga' => 15000,
        ]);

        kategoriItem::factory()->create([
            // 'idKategoriItem' => 1,
            'namaKategori' => 'Pakaian',
        ]);   

        detailTransaksi::factory()->create([
            'idPesanan' => 1,
            'idKategoriItem' => 1,
            'beratItem' => 3,
        ]);

        transaksiPembayaran::factory()->create([
            'idDetailTransaksi' => 1,
            'metodePembayaran' => 'Transfer Bank',
            'tanggalPembayaran' => now(),
            'totalPembayaran' => 15000,
        ]);
        pengaduan::factory()->create([
            'idPelanggan' => 1,
            'idPesanan' => 1,
            'tanggalPengaduan' => now(),
            'deskripsi' => 'Pakaian hilang',
        ]);




    }
}
