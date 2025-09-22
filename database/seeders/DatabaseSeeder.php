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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $kurir = Kurir::factory()->create([
            'namaKurir' => 'Kurir 1',
            'noHp' => '081234567891',
            'alamat' => 'Jl. Kurir No. 1',
        ]);

        $pelanggan = Pelanggan::factory()->create([
            'namaPelanggan' => 'Pelanggan 1',
            'username' => 'pelanggan1',
            'password' => bcrypt('password123'),
            'email' => 'pelanggan@gmail.com',    
            'otp' => now(),
            'alamat' => 'Jl. Pelanggan No. 1',
            'noHp' => '081234567892',
        ]);

        $karyawan = Karyawan::factory()->create([
            'namaKaryawan' => 'Karyawan 1',
            'username' => 'karyawan1',
            'password' => bcrypt('password123'),
            'alamat' => 'Jl. Karyawan No. 1',
            'noHp' => '081234567890',
        ]);

        $layanan = Layanan::factory()->create([
            'namaLayanan' => 'Cuci Kering',
            'hargaPerKg' => 5000,
            'estimasiHari' => 2,
        ]);

        $pesanan = Pesanan::factory()->create([
            'namaPesanan' => 'Pesanan 1',
            'idPelanggan' => $pelanggan -> id,
            'idLayanan' => $layanan -> id,
            'idKurir' => $kurir -> id,
            'idKaryawan' => $karyawan -> id,
            'statusPesanan' => false,
            'tanggalMasuk' => now(),
            'tanggalSelesai' => now()->addDays(2),
            'totalHarga' => 15000,
        ]);

        $kategori = KategoriItem::factory()->create([
            'namaKategori' => 'Pakaian',
        ]);   

        $detail = DetailTransaksi::factory()->create([
            'idPesanan' => $pesanan -> id,
            'idKategoriItem' => $kategori -> id,
            'beratItem' => 3,
        ]);

        TransaksiPembayaran::factory()->create([
            'idDetailTransaksi' => $detail -> id,
            'metodePembayaran' => 'Transfer Bank',
            'tanggalPembayaran' => now(),
            'totalPembayaran' => 15000,
        ]);
        Pengaduan::factory()->create([
            'idPelanggan' => $pelanggan -> id,
            'idPesanan' => $pesanan -> id,
            'tanggalPengaduan' => now(),
            'deskripsi' => 'Pakaian hilang',
        ]);
    }
}
