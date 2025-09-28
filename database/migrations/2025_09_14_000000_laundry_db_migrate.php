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
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('idPelanggan');
            $table->string('namaPelanggan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('otp');
            $table->string('alamat');
            $table->string('noHp')->unique();
        });

        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('idKaryawan');
            $table->string('namaKaryawan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('alamat')->nullable();
            $table->string('noHp')->unique();
        });

        Schema::create('layanan', function (Blueprint $table) {
            $table->id('idLayanan');
            $table->string('namaLayanan');
            $table->integer('hargaPerKg', 10, 2);
            $table->integer('estimasiHari');
        });

        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('idPesanan');
            $table->string('namaPesanan');
            $table->foreignId('idPelanggan')->constrained('pelanggan', 'idPelanggan')->onDelete('cascade');
            $table->foreignId('idLayanan')->constrained('layanan', 'idLayanan')->onDelete('cascade');
            $table->foreignId('idKurir')->constrained('kurir', 'idKurir')->onDelete('cascade');
            $table->foreignId('idKaryawan')->constrained('karyawan', 'idKaryawan')->onDelete('cascade');
            $table->boolean('statusPesanan');
            $table->date('tanggalMasuk');
            $table->date('tanggalSelesai');
            $table->integer('totalHarga', 12, 2);
        });

        Schema::create('kategoriItem', function (Blueprint $table) {
            $table->id('idKategoriItem');
            $table->string('namaKategori');
        });

        Schema::create('detailTransaksi', function (Blueprint $table) {
            $table->id('idDetailTransaksi');
            $table->foreignId('idPesanan')->constrained('pesanan', 'idPesanan')->onDelete('cascade');
            $table->foreignId('idKategoriItem')->constrained('kategoriItem', 'idKategoriItem')->onDelete('cascade');
        });

        Schema::create('transaksiPembayaran', function (Blueprint $table) {
            $table->id('idTransaksiPembayaran');
            $table->foreignId('idDetailTransaksi')->constrained('detailTransaksi', 'idDetailTransaksi')->onDelete('cascade');
            $table->string('metodePembayaran');
            $table->date('tanggalPembayaran');
            $table->integer('totalPembayaran', 12, 2);
        });

        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('idPengaduan');
            $table->foreignId('idPelanggan')->constrained('pelanggan', 'idPelanggan')->onDelete('cascade');
            $table->foreignId('idPesanan')->constrained('pesanan', 'idPesanan')->onDelete('cascade');
            $table->date('tanggalPengaduan');
            $table->text('deskripsi')->nullable();
            $table->string('judulPengaduan');
            $table->string('media');
            $table->string('tanggapanPengaduan')->nullable();
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
    }
};
