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
        Schema::table('pelanggan', function (Blueprint $table) {
            // Hapus kolom OTP jika ada
            if (Schema::hasColumn('pelanggan', 'otp')) {
                $table->dropColumn('otp');
            }

            // Contoh update kolom yang ada
            // Ubah panjang atau tipe kolom, misalnya:
            // $table->string('no_hp', 20)->nullable()->change();

            // Tambahkan kolom baru (jika perlu)
            // $table->string('alamat')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            // Balikkan perubahan (optional)
            // $table->string('otp')->nullable();
            // $table->dropColumn('alamat');
        });
    }
};
