<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kurir', function (Blueprint $table) {
            $table->id('idKurir');
            $table->string('namaKurir');
            $table->string('noHp')->unique();
            $table->string('alamat')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('idPelanggan');
            $table->string('namaPelanggan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('otp')->nullable();
            $table->dateTime('otp_expires_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('alamat')->nullable();
            $table->string('noHp', 13)->nullable();
            $table->timestamps();
        });

        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('idKaryawan');
            $table->string('namaKaryawan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('alamat')->nullable();
            $table->string('noHp')->unique();
            $table->timestamps();
        });

        Schema::create('layanan', function (Blueprint $table) {
            $table->id('idLayanan');
            $table->string('namaLayanan');
            $table->decimal('hargaPerKg', 10, 2);
            $table->integer('estimasiHari');
        });

        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('idPesanan');
            $table->foreignId('idPelanggan')->constrained('pelanggan', 'idPelanggan')->onDelete('cascade');
            $table->foreignId('idLayanan')->constrained('layanan', 'idLayanan')->onDelete('cascade');
            $table->foreignId('idKurir')->nullable()->constrained('kurir', 'idKurir')->onDelete('cascade');
            $table->foreignId('idKaryawan')->nullable()->constrained('karyawan', 'idKaryawan')->onDelete('cascade');
            $table->enum('statusPesanan', [
                'Menunggu Verifikasi',
                'Menunggu Penjemputan',
                'Menunggu Pembayaran',
                'Diproses',
                'Menunggu Pengantaran',
                'Sudah Diantar',
                'Selesai'
            ])->default('Menunggu Verifikasi');
            $table->string('alamat')->nullable();
            $table->string('paket')->nullable();
            $table->integer('pakaian')->default(0);
            $table->integer('seprai')->default(0);
            $table->integer('handuk')->default(0);
            $table->decimal('beratBarang', 8, 2)->nullable();
            $table->date('tanggalMasuk');
            $table->date('tanggalSelesai')->nullable();
            $table->decimal('totalHarga', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('kategoriItem', function (Blueprint $table) {
            $table->id('idKategoriItem');
            $table->string('namaKategori');
            $table->integer('jumlahItem')->default(0);
            $table->decimal('hargaPerItem', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('detailTransaksi', function (Blueprint $table) {
            $table->id('idDetailTransaksi');
            $table->foreignId('idPesanan')->constrained('pesanan', 'idPesanan')->onDelete('cascade');
            $table->foreignId('idKategoriItem')->constrained('kategoriItem', 'idKategoriItem')->onDelete('cascade');
            $table->integer('jumlahKategori')->default(0);
            $table->timestamps();
        });

        Schema::create('transaksiPembayaran', function (Blueprint $table) {
            $table->id('idTransaksiPembayaran');
            $table->foreignId('idDetailTransaksi')->constrained('detailTransaksi', 'idDetailTransaksi')->onDelete('cascade');
            $table->dateTime('tanggalPembayaran')->nullable();
            $table->decimal('totalPembayaran', 12, 2);
            $table->string('buktiPembayaran')->nullable();
            $table->string('kodePembayaran', 6)->unique();
            $table->timestamps();
        });

        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('idPengaduan');
            $table->foreignId('idPelanggan')->constrained('pelanggan', 'idPelanggan')->onDelete('cascade');
            $table->foreignId('idPesanan')->constrained('pesanan', 'idPesanan')->onDelete('cascade');
            $table->date('tanggalPengaduan');
            $table->text('deskripsi')->nullable();
            $table->string('judulPengaduan');
            $table->string('media')->nullable();
            $table->string('statusPengaduan')->default('Belum Ditanggapi');
            $table->string('tanggapanPengaduan')->nullable();
            $table->timestamps();
        });

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        // Schema::create('sessions', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
        Schema::dropIfExists('transaksiPembayaran');
        Schema::dropIfExists('detailTransaksi');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('kategoriItem');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('karyawan');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('kurir');
        Schema::dropIfExists('sessions');
    }
};
